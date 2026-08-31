<?php

namespace App\Services\Tracking;

use App\Models\TrackingSetting;
use App\Models\TrackingLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GA4MeasurementProtocolService
{
    /**
     * Send event to GA4 Measurement Protocol.
     *
     * @param string $eventName
     * @param string $eventId
     * @param array $eventParams
     * @param string|null $clientId
     * @param string|null $userId
     * @param bool $isDebug
     * @return array ['success' => bool, 'status' => int, 'response' => array, 'latency_ms' => float]
     */
    public static function sendEvent($eventName, $eventId, array $eventParams = [], $clientId = null, $userId = null, $isDebug = false)
    {
        $startTime = microtime(true);

        $measurementId = TrackingSetting::get('ga4_measurement_id');
        $apiSecret = TrackingSetting::get('ga4_api_secret');

        if (empty($measurementId) || empty($apiSecret)) {
            return [
                'success' => false,
                'status' => 400,
                'response' => ['error' => 'GA4 Measurement ID or API Secret is missing.'],
                'latency_ms' => 0
            ];
        }

        $endpoint = $isDebug 
            ? 'https://www.google-analytics.com/debug/mp/collect' 
            : 'https://www.google-analytics.com/mp/collect';

        $url = "{$endpoint}?api_secret={$apiSecret}&measurement_id={$measurementId}";

        // Standardize event name for GA4 (e.g. AddToCart -> add_to_cart, Purchase -> purchase)
        $ga4EventName = static::normalizeEventName($eventName);

        // Resolve client ID (from _ga cookie or session/event_id)
        $resolvedClientId = $clientId ?: static::extractGaClientId() ?: 'ga4_' . substr(md5(session()->getId() ?: $eventId), 0, 16);

        // Attach event_id inside parameters for deduplication with GTM
        $eventParams['event_id'] = $eventId;

        $payload = [
            'client_id' => $resolvedClientId,
            'events' => [
                [
                    'name' => $ga4EventName,
                    'params' => $eventParams,
                ]
            ],
        ];

        if ($userId) {
            $payload['user_id'] = (string)$userId;
        }

        $httpStatus = null;
        $responseData = [];

        try {
            $response = Http::timeout(5)->post($url, $payload);
            $latencyMs = round((microtime(true) - $startTime) * 1000, 2);
            $httpStatus = $response->status();
            $responseData = $response->json() ?: ['body' => $response->body() ?: 'Event accepted'];

            // Record log in tracking_logs
            static::recordLog('ga4_measurement_protocol', $eventName, $eventId, $payload, $responseData, $httpStatus);

            return [
                'success' => $response->successful(),
                'status' => $httpStatus,
                'response' => $responseData,
                'latency_ms' => $latencyMs
            ];

        } catch (\Exception $e) {
            $latencyMs = round((microtime(true) - $startTime) * 1000, 2);
            Log::error('GA4 MP Exception: ' . $e->getMessage());

            $responseData = ['error' => $e->getMessage()];
            static::recordLog('ga4_measurement_protocol', $eventName, $eventId, $payload, $responseData, 500);

            return [
                'success' => false,
                'status' => 500,
                'response' => $responseData,
                'latency_ms' => $latencyMs
            ];
        }
    }

    /**
     * Normalize e-commerce event names into GA4 conventions.
     *
     * @param string $name
     * @return string
     */
    protected static function normalizeEventName($name)
    {
        $map = [
            'PageView' => 'page_view',
            'ViewContent' => 'view_item',
            'AddToCart' => 'add_to_cart',
            'InitiateCheckout' => 'begin_checkout',
            'AddPaymentInfo' => 'add_payment_info',
            'Purchase' => 'purchase',
            'Lead' => 'generate_lead',
        ];

        return $map[$name] ?? strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }

    /**
     * Extract client ID from standard _ga cookie if present.
     *
     * @return string|null
     */
    protected static function extractGaClientId()
    {
        if (request() && request()->hasCookie('_ga')) {
            $gaCookie = request()->cookie('_ga');
            $parts = explode('.', $gaCookie);
            if (count($parts) >= 4) {
                return $parts[2] . '.' . $parts[3];
            }
        }
        return null;
    }

    /**
     * Live Test Event Ping to GA4 debug endpoint.
     *
     * @return array
     */
    public static function sendTestPing()
    {
        $testEventId = 'test_ga4_ping_' . uniqid();
        return static::sendEvent('Purchase', $testEventId, [
            'currency' => 'USD',
            'value' => 0.00,
            'transaction_id' => 'TEST_TX_' . time(),
            'items' => [
                [
                    'item_id' => 'test_sku_001',
                    'item_name' => 'Connection Verification Test Item',
                    'price' => 0.00,
                    'quantity' => 1
                ]
            ]
        ], null, null, true);
    }

    /**
     * Record log in tracking_logs.
     */
    protected static function recordLog($channel, $eventName, $eventId, $payload, $responseData, $httpStatus)
    {
        try {
            $log = TrackingLog::where('event_id', $eventId)->where('channel', $channel)->first();
            if ($log) {
                $log->update([
                    'payload' => $payload,
                    'response_data' => $responseData,
                    'http_status' => $httpStatus,
                    'attempts' => $log->attempts + 1,
                ]);
            } else {
                TrackingLog::create([
                    'channel' => $channel,
                    'event_name' => $eventName,
                    'event_id' => $eventId,
                    'payload' => $payload,
                    'response_data' => $responseData,
                    'http_status' => $httpStatus,
                    'attempts' => 1,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to write GA4 tracking log: ' . $e->getMessage());
        }
    }
}
