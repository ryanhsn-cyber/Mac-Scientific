<?php

namespace App\Services\Tracking;

use App\Models\TrackingSetting;
use App\Models\CustomTrackingEvent;
use App\Jobs\SendMetaCapiJob;
use App\Jobs\SendGA4MeasurementJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TrackingManager
{
    /**
     * Generate a unique deduplication event ID.
     *
     * @param string $eventType
     * @param string|int|null $contextId
     * @return string
     */
    public static function generateEventId($eventType, $contextId = null)
    {
        $sessionId = Session::getId() ?: substr(md5(microtime()), 0, 10);
        $time = time();

        switch ($eventType) {
            case 'PageView':
                return "pv_{$sessionId}_{$time}";

            case 'ViewContent':
                $productId = $contextId ?: '0';
                return "vc_{$productId}_{$sessionId}";

            case 'AddToCart':
                $itemId = $contextId ?: 'item';
                return "atc_{$itemId}_{$time}";

            case 'InitiateCheckout':
                $cartId = $contextId ?: $sessionId;
                return "ic_{$cartId}";

            case 'AddPaymentInfo':
                $orderId = $contextId ?: 'ord_' . $time;
                return "api_{$orderId}";

            case 'Purchase':
                $orderId = $contextId ?: 'ord_' . $time;
                return "pur_{$orderId}";

            case 'Lead':
                $formId = $contextId ?: 'contact';
                return "lead_{$formId}_{$time}";

            default:
                return 'evt_' . (string)Str::uuid();
        }
    }

    /**
     * Check if a browser (client-side) event should be tracked.
     *
     * @param string $eventName
     * @return bool
     */
    public static function shouldTrackBrowser($eventName)
    {
        $key = 'track_browser_' . strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $eventName));
        return TrackingSetting::get($key, '1') == '1';
    }

    /**
     * Check if a server-side event should be tracked.
     *
     * @param string $eventName
     * @return bool
     */
    public static function shouldTrackServer($eventName)
    {
        $key = 'track_server_' . strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $eventName));
        return TrackingSetting::get($key, '1') == '1';
    }

    /**
     * Track an event across all configured server destinations.
     *
     * @param string $eventName
     * @param string $eventId
     * @param array $customData
     * @param array $userData
     * @param string|null $eventSourceUrl
     * @return void
     */
    public static function trackServerEvent($eventName, $eventId, array $customData = [], array $userData = [], $eventSourceUrl = null)
    {
        // 1. Meta Conversions API (CAPI)
        $metaCapiEnabled = TrackingSetting::get('enable_meta_capi', '0') == '1';
        if ($metaCapiEnabled && static::shouldTrackServer($eventName)) {
            SendMetaCapiJob::dispatch(
                $eventName,
                $eventId,
                $customData,
                $userData,
                $eventSourceUrl ?: (url()->current() ?: config('app.url'))
            );
        }

        // 2. GA4 Measurement Protocol
        $ga4MeasurementId = TrackingSetting::get('ga4_measurement_id');
        $ga4ApiSecret = TrackingSetting::get('ga4_api_secret');
        if (!empty($ga4MeasurementId) && !empty($ga4ApiSecret) && static::shouldTrackServer($eventName)) {
            SendGA4MeasurementJob::dispatch(
                $eventName,
                $eventId,
                $customData
            );
        }

        // 3. Evaluate Dynamic Server-Side Custom Events
        static::evaluateServerCustomEvents($eventName, $customData, $userData);
    }

    /**
     * Evaluate dynamic custom events created via Event Builder.
     *
     * @param string $triggerName
     * @param array $data
     * @param array $userData
     * @return void
     */
    protected static function evaluateServerCustomEvents($triggerName, array $data = [], array $userData = [])
    {
        try {
            $customEvents = CustomTrackingEvent::active()->serverSide()->get();

            foreach ($customEvents as $event) {
                if ($event->trigger_target === $triggerName || $event->event_name === $triggerName) {
                    $eventId = 'custom_' . (string)Str::uuid();
                    $destinations = is_array($event->destinations) ? $event->destinations : [];

                    // Map payload schema
                    $mappedData = [];
                    if (!empty($event->payload_schema) && is_array($event->payload_schema)) {
                        foreach ($event->payload_schema as $mapping) {
                            $key = $mapping['key'] ?? '';
                            $source = $mapping['source'] ?? '';
                            if ($key && $source) {
                                $mappedData[$key] = data_get($data, $source, $source);
                            }
                        }
                    } else {
                        $mappedData = $data;
                    }

                    if (in_array('meta_capi', $destinations) && TrackingSetting::get('enable_meta_capi') == '1') {
                        SendMetaCapiJob::dispatch($event->event_name, $eventId, $mappedData, $userData);
                    }

                    if (in_array('ga4', $destinations) && !empty(TrackingSetting::get('ga4_measurement_id'))) {
                        SendGA4MeasurementJob::dispatch($event->event_name, $eventId, $mappedData);
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently ignore custom rule parsing issues
        }
    }

    /**
     * Get platform active statuses for UI badges.
     *
     * @return array
     */
    public static function getPlatformStatuses()
    {
        $gtmEnabled = TrackingSetting::get('enable_gtm', '0') == '1' && !empty(TrackingSetting::get('gtm_container_id'));
        $ga4DirectEnabled = TrackingSetting::get('enable_ga4_direct', '0') == '1' && !empty(TrackingSetting::get('ga4_measurement_id'));
        $metaPixelEnabled = TrackingSetting::get('enable_meta_pixel', '0') == '1' && !empty(TrackingSetting::get('meta_pixel_id'));
        $metaCapiEnabled = TrackingSetting::get('enable_meta_capi', '0') == '1' && !empty(TrackingSetting::get('meta_pixel_id')) && !empty(TrackingSetting::get('meta_capi_token'));

        return [
            'gtm' => [
                'name' => 'GTM Container',
                'active' => $gtmEnabled,
                'badge' => $gtmEnabled ? 'Active' : 'Inactive',
                'color' => $gtmEnabled ? 'success' : 'secondary',
            ],
            'ga4_direct' => [
                'name' => 'Direct GA4',
                'active' => $ga4DirectEnabled,
                'badge' => $ga4DirectEnabled ? 'Active' : 'Inactive',
                'color' => $ga4DirectEnabled ? 'success' : 'secondary',
            ],
            'meta_pixel' => [
                'name' => 'Meta Pixel',
                'active' => $metaPixelEnabled,
                'badge' => $metaPixelEnabled ? 'Active' : 'Inactive',
                'color' => $metaPixelEnabled ? 'success' : 'secondary',
            ],
            'meta_capi' => [
                'name' => 'Meta CAPI',
                'active' => $metaCapiEnabled,
                'badge' => $metaCapiEnabled ? 'Active' : 'Inactive',
                'color' => $metaCapiEnabled ? 'success' : 'secondary',
            ],
        ];
    }
}
