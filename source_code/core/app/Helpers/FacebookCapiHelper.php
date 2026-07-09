<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookCapiHelper
{
    /**
     * Send a standard event to Facebook Conversions API
     */
    public static function sendEvent($eventName, $eventData = [], $userData = [])
    {
        try {
            $setting = Setting::first();
            
            if (!$setting || $setting->is_facebook_capi != 1 || empty($setting->facebook_pixel_id) || empty($setting->facebook_capi_token)) {
                return false;
            }

            // Check individual event toggles
            if ($eventName === 'ViewContent' && $setting->is_facebook_capi_view_content != 1) return false;
            if ($eventName === 'AddToCart' && $setting->is_facebook_capi_add_to_cart != 1) return false;
            if ($eventName === 'Purchase' && $setting->is_facebook_capi_purchase != 1) return false;
            if ($eventName === 'InitiateCheckout' && $setting->is_facebook_capi_initiate_checkout != 1) return false;

            $pixelId = $setting->facebook_pixel_id;
            $accessToken = $setting->facebook_capi_token;
            $testEventCode = $setting->facebook_capi_test_code;

            $url = "https://graph.facebook.com/v19.0/{$pixelId}/events";

            $clientIp = request()->ip();
            $clientUserAgent = request()->userAgent();
            
            $baseUserData = [
                'client_ip_address' => $clientIp,
                'client_user_agent' => $clientUserAgent,
            ];
            
            // FBP and FBC cookies
            if (request()->hasCookie('_fbp')) {
                $baseUserData['fbp'] = request()->cookie('_fbp');
            }
            if (request()->hasCookie('_fbc')) {
                $baseUserData['fbc'] = request()->cookie('_fbc');
            }

            // Merge with provided user data (like email, phone)
            $finalUserData = array_merge($baseUserData, $userData);

            $payload = [
                'data' => [
                    [
                        'event_name' => $eventName,
                        'event_time' => time(),
                        'action_source' => 'website',
                        'event_source_url' => url()->current(),
                        'user_data' => $finalUserData,
                        'custom_data' => $eventData,
                    ]
                ],
            ];

            if (!empty($testEventCode)) {
                $payload['test_event_code'] = $testEventCode;
            }

            $response = Http::post($url . '?access_token=' . $accessToken, $payload);
            
            if (!$response->successful()) {
                Log::error('Facebook CAPI Error: ' . $response->body());
            }

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('Facebook CAPI Exception: ' . $e->getMessage());
            return false;
        }
    }
}
