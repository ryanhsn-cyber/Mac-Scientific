<?php

namespace App\Services\Tracking;

use App\Models\TrackingSetting;
use App\Models\TrackingLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaCapiService
{
    /**
     * Send event to Meta Conversions API.
     *
     * @param string $eventName
     * @param string $eventId
     * @param array $customData
     * @param array $userData
     * @param string|null $eventSourceUrl
     * @return array ['success' => bool, 'status' => int, 'response' => array, 'latency_ms' => float]
     */
    public static function sendEvent($eventName, $eventId, array $customData = [], array $userData = [], $eventSourceUrl = null)
    {
        $startTime = microtime(true);

        $pixelId = TrackingSetting::get('meta_pixel_id');
        $accessToken = TrackingSetting::get('meta_capi_token');
        $testEventCode = TrackingSetting::get('meta_capi_test_code');

        if (empty($pixelId) || empty($accessToken)) {
            return [
                'success' => false,
                'status' => 400,
                'response' => ['error' => 'Meta Pixel ID or CAPI Access Token is missing.'],
                'latency_ms' => 0
            ];
        }

        $url = "https://graph.facebook.com/v19.0/{$pixelId}/events";

        // Build User Data with Advanced Matching (SHA-256 hashed where applicable)
        $formattedUserData = static::formatUserData($userData);

        $eventPayload = [
            'event_name' => $eventName,
            'event_time' => time(),
            'event_id' => $eventId,
            'action_source' => 'website',
            'event_source_url' => $eventSourceUrl ?: (url()->current() ?: config('app.url')),
            'user_data' => $formattedUserData,
        ];

        if (!empty($customData)) {
            $eventPayload['custom_data'] = $customData;
        }

        $payload = [
            'data' => [$eventPayload],
        ];

        if (!empty($testEventCode)) {
            $payload['test_event_code'] = $testEventCode;
        }

        $httpStatus = null;
        $responseData = [];

        try {
            $response = Http::timeout(10)->post($url . '?access_token=' . $accessToken, $payload);
            $latencyMs = round((microtime(true) - $startTime) * 1000, 2);
            $httpStatus = $response->status();
            $responseData = $response->json() ?: ['body' => $response->body()];

            // Log the event
            static::recordLog('meta_capi', $eventName, $eventId, $payload, $responseData, $httpStatus);

            return [
                'success' => $response->successful(),
                'status' => $httpStatus,
                'response' => $responseData,
                'latency_ms' => $latencyMs
            ];

        } catch (\Exception $e) {
            $latencyMs = round((microtime(true) - $startTime) * 1000, 2);
            Log::error('Meta CAPI Exception: ' . $e->getMessage());
            
            $responseData = ['error' => $e->getMessage()];
            static::recordLog('meta_capi', $eventName, $eventId, $payload, $responseData, 500);

            return [
                'success' => false,
                'status' => 500,
                'response' => $responseData,
                'latency_ms' => $latencyMs
            ];
        }
    }

    /**
     * Format and hash user data according to Meta CAPI specification.
     *
     * @param array $userData
     * @return array
     */
    public static function formatUserData(array $userData = [])
    {
        $clientIp = request() ? request()->ip() : null;
        $clientUserAgent = request() ? request()->userAgent() : null;

        $formatted = [
            'client_ip_address' => $clientIp,
            'client_user_agent' => $clientUserAgent,
        ];

        // Cookies
        if (request() && request()->hasCookie('_fbp')) {
            $formatted['fbp'] = request()->cookie('_fbp');
        }
        if (request() && request()->hasCookie('_fbc')) {
            $formatted['fbc'] = request()->cookie('_fbc');
        }

        // Advanced Matching with SHA-256
        $matchingToggles = [
            'em' => TrackingSetting::get('meta_advanced_matching_em', '1'),
            'ph' => TrackingSetting::get('meta_advanced_matching_ph', '1'),
            'fn' => TrackingSetting::get('meta_advanced_matching_fn', '1'),
            'ln' => TrackingSetting::get('meta_advanced_matching_ln', '1'),
            'ct' => TrackingSetting::get('meta_advanced_matching_ct', '1'),
            'zp' => TrackingSetting::get('meta_advanced_matching_zp', '1'),
        ];

        if (!empty($userData['em']) && $matchingToggles['em']) {
            $formatted['em'] = static::hashValue($userData['em']);
        }
        if (!empty($userData['ph']) && $matchingToggles['ph']) {
            // Clean phone numbers (remove non-digits) before hashing
            $cleanPhone = preg_replace('/\D+/', '', $userData['ph']);
            $formatted['ph'] = static::hashValue($cleanPhone);
        }
        if (!empty($userData['fn']) && $matchingToggles['fn']) {
            $formatted['fn'] = static::hashValue($userData['fn']);
        }
        if (!empty($userData['ln']) && $matchingToggles['ln']) {
            $formatted['ln'] = static::hashValue($userData['ln']);
        }
        if (!empty($userData['ct']) && $matchingToggles['ct']) {
            $formatted['ct'] = static::hashValue(strtolower(preg_replace('/[^a-z]/', '', $userData['ct'])));
        }
        if (!empty($userData['zp']) && $matchingToggles['zp']) {
            $formatted['zp'] = static::hashValue(strtolower(trim($userData['zp'])));
        }

        return array_filter($formatted, function($value) {
            return $value !== null && $value !== '';
        });
    }

    /**
     * SHA-256 hash string after normalizing.
     *
     * @param string $value
     * @return string
     */
    protected static function hashValue($value)
    {
        $normalized = strtolower(trim((string)$value));
        // If already SHA-256 (64 hex characters), return as is
        if (preg_match('/^[a-f0-9]{64}$/', $normalized)) {
            return $normalized;
        }
        return hash('sha256', $normalized);
    }

    /**
     * Live Connection Health Check Ping.
     *
     * @return array
     */
    public static function sendTestPing()
    {
        $testEventId = 'test_ping_' . uniqid();
        return static::sendEvent('Purchase', $testEventId, [
            'currency' => 'USD',
            'value' => 0.00,
            'content_name' => 'Connection Verification Test Event',
            'content_ids' => ['test_sku_001'],
            'content_type' => 'product'
        ], [
            'em' => 'test_user@example.com',
            'fn' => 'Test',
            'ln' => 'User'
        ]);
    }

    /**
     * Record log entry in tracking_logs.
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
            Log::error('Failed to write tracking log: ' . $e->getMessage());
        }
    }
}
