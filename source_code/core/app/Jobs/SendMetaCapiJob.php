<?php

namespace App\Jobs;

use App\Services\Tracking\MetaCapiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMetaCapiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $eventName;
    public $eventId;
    public $customData;
    public $userData;
    public $eventSourceUrl;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var array
     */
    public $backoff = [10, 30, 60];

    /**
     * Create a new job instance.
     *
     * @param string $eventName
     * @param string $eventId
     * @param array $customData
     * @param array $userData
     * @param string|null $eventSourceUrl
     */
    public function __construct($eventName, $eventId, array $customData = [], array $userData = [], $eventSourceUrl = null)
    {
        $this->eventName = $eventName;
        $this->eventId = $eventId;
        $this->customData = $customData;
        $this->userData = $userData;
        $this->eventSourceUrl = $eventSourceUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $result = MetaCapiService::sendEvent(
                $this->eventName,
                $this->eventId,
                $this->customData,
                $this->userData,
                $this->eventSourceUrl
            );

            if (!$result['success'] && config('queue.default') !== 'sync' && $this->attempts() < $this->tries) {
                throw new \Exception("Meta CAPI HTTP {$result['status']}: " . json_encode($result['response']));
            }
        } catch (\Exception $e) {
            Log::error("SendMetaCapiJob Error ({$this->eventName}): " . $e->getMessage());
            if (config('queue.default') !== 'sync') {
                throw $e;
            }
        }
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error("SendMetaCapiJob permanently failed for {$this->eventName} ({$this->eventId}): " . $exception->getMessage());
    }
}
