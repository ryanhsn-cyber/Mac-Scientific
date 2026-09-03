<?php

namespace App\Repositories\Back;

use App\Models\TrackingSetting;
use App\Models\CustomTrackingEvent;
use App\Models\TrackingLog;
use App\Jobs\SendMetaCapiJob;
use App\Jobs\SendGA4MeasurementJob;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackingRepository
{
    /**
     * Get all tracking settings.
     *
     * @return array
     */
    public function getSettings()
    {
        return TrackingSetting::getAllSettings();
    }

    /**
     * Update settings in bulk.
     *
     * @param array $data
     * @return void
     */
    public function updateSettings(array $data)
    {
        $googleBooleanKeys = [
            'enable_gtm',
            'enable_ga4_direct',
            'auto_push_datalayer',
        ];

        $metaBooleanKeys = [
            'enable_meta_pixel',
            'enable_meta_capi',
            'meta_advanced_matching_em',
            'meta_advanced_matching_ph',
            'meta_advanced_matching_fn',
            'meta_advanced_matching_ln',
            'meta_advanced_matching_ct',
            'meta_advanced_matching_zp',
            'track_browser_pageview',
            'track_server_pageview',
            'track_browser_view_content',
            'track_server_view_content',
            'track_browser_add_to_cart',
            'track_server_add_to_cart',
            'track_browser_initiate_checkout',
            'track_server_initiate_checkout',
            'track_browser_add_payment_info',
            'track_server_add_payment_info',
            'track_browser_purchase',
            'track_server_purchase',
            'track_browser_lead',
            'track_server_lead',
        ];

        $formSource = $data['form_source'] ?? null;
        $isGoogleSection = $formSource === 'google' || isset($data['gtm_container_id']) || isset($data['ga4_measurement_id']);
        $isMetaSection = $formSource === 'meta' || isset($data['meta_pixel_id']) || isset($data['meta_capi_token']);

        // Only process the boolean checkboxes belonging to the submitted tab
        if ($isGoogleSection) {
            foreach ($googleBooleanKeys as $key) {
                $data[$key] = isset($data[$key]) ? '1' : '0';
            }
        }

        if ($isMetaSection) {
            foreach ($metaBooleanKeys as $key) {
                $data[$key] = isset($data[$key]) ? '1' : '0';
            }
        }

        foreach ($data as $key => $value) {
            if ($key === '_token' || $key === 'form_source') continue;
            TrackingSetting::set($key, $value);
        }
    }

    /**
     * Get all custom tracking event rules.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCustomEvents()
    {
        return CustomTrackingEvent::orderBy('id', 'desc')->get();
    }

    /**
     * Save (create/update) a custom tracking event rule.
     *
     * @param array $data
     * @param int|null $id
     * @return CustomTrackingEvent
     */
    public function saveCustomEvent(array $data, $id = null)
    {
        $payloadSchema = [];
        if (!empty($data['payload_keys']) && is_array($data['payload_keys'])) {
            foreach ($data['payload_keys'] as $idx => $key) {
                if (!empty($key)) {
                    $payloadSchema[] = [
                        'key' => trim($key),
                        'source' => trim($data['payload_sources'][$idx] ?? ''),
                    ];
                }
            }
        }

        $destinations = $data['destinations'] ?? [];
        if (is_string($destinations)) {
            $destinations = json_decode($destinations, true) ?: [$destinations];
        }

        $attributes = [
            'event_name' => trim($data['event_name']),
            'trigger_type' => $data['trigger_type'],
            'trigger_target' => trim($data['trigger_target']),
            'destinations' => $destinations,
            'payload_schema' => $payloadSchema,
            'is_active' => isset($data['is_active']) ? (bool)$data['is_active'] : true,
        ];

        if ($id) {
            $event = CustomTrackingEvent::findOrFail($id);
            $event->update($attributes);
            return $event;
        }

        return CustomTrackingEvent::create($attributes);
    }

    /**
     * Delete custom tracking event rule.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCustomEvent($id)
    {
        return CustomTrackingEvent::where('id', $id)->delete();
    }

    /**
     * Toggle custom event active state.
     *
     * @param int $id
     * @return CustomTrackingEvent
     */
    public function toggleCustomEvent($id)
    {
        $event = CustomTrackingEvent::findOrFail($id);
        $event->is_active = !$event->is_active;
        $event->save();
        return $event;
    }

    /**
     * Query tracking logs with filters and pagination.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLogs(Request $request)
    {
        $query = TrackingLog::orderBy('id', 'desc');

        if ($request->filled('channel') && $request->channel !== 'all') {
            $query->where('channel', $request->channel);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'success') {
                $query->whereBetween('http_status', [200, 299]);
            } elseif ($request->status === 'failed') {
                $query->where(function($q) {
                    $q->where('http_status', '>=', 400)
                      ->orWhereNull('http_status');
                });
            }
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('event_name', 'like', $search)
                  ->orWhere('event_id', 'like', $search);
            });
        }

        return $query->paginate(15);
    }

    /**
     * Get single log details.
     *
     * @param int $id
     * @return TrackingLog
     */
    public function getLogDetails($id)
    {
        return TrackingLog::findOrFail($id);
    }

    /**
     * Retry a failed tracking log.
     *
     * @param int $id
     * @return array
     */
    public function retryLog($id)
    {
        $log = TrackingLog::findOrFail($id);
        $payload = $log->payload;

        if ($log->channel === 'meta_capi') {
            $data = $payload['data'][0] ?? [];
            $eventName = $data['event_name'] ?? $log->event_name;
            $eventId = $data['event_id'] ?? $log->event_id;
            $customData = $data['custom_data'] ?? [];
            $userData = $data['user_data'] ?? [];

            SendMetaCapiJob::dispatch($eventName, $eventId, $customData, $userData);

            $log->increment('attempts');
            return ['success' => true, 'message' => 'Meta CAPI event queued for retry.'];
        }

        if ($log->channel === 'ga4_measurement_protocol') {
            $event = $payload['events'][0] ?? [];
            $eventName = $event['name'] ?? $log->event_name;
            $params = $event['params'] ?? [];
            $clientId = $payload['client_id'] ?? null;
            $userId = $payload['user_id'] ?? null;

            SendGA4MeasurementJob::dispatch($eventName, $log->event_id, $params, $clientId, $userId);

            $log->increment('attempts');
            return ['success' => true, 'message' => 'GA4 Measurement Protocol event queued for retry.'];
        }

        return ['success' => false, 'message' => 'Unknown channel.'];
    }

    /**
     * Prune old tracking logs.
     *
     * @param int $days
     * @return int Number of deleted records
     */
    public function pruneLogs($days = 30)
    {
        $cutoffDate = Carbon::now()->subDays((int)$days);
        return TrackingLog::where('created_at', '<', $cutoffDate)->delete();
    }
}
