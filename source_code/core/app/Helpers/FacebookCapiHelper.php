<?php

namespace App\Helpers;

use App\Services\Tracking\TrackingManager;
use App\Services\Tracking\MetaCapiService;

class FacebookCapiHelper
{
    /**
     * Send a standard or custom event to Meta Conversions API (and GA4 Server).
     *
     * @param string $eventName
     * @param array $eventData
     * @param array $userData
     * @param string|null $eventId
     * @return bool
     */
    public static function sendEvent($eventName, $eventData = [], $userData = [], $eventId = null)
    {
        try {
            $resolvedEventId = $eventId ?: TrackingManager::generateEventId($eventName);

            // Track across server pipeline
            TrackingManager::trackServerEvent($eventName, $resolvedEventId, $eventData, $userData);

            return true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('FacebookCapiHelper Error: ' . $e->getMessage());
            return false;
        }
    }
}
