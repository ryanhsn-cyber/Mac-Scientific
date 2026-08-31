<?php

namespace App\Jobs;

use App\Services\Tracking\GA4MeasurementProtocolService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendGA4MeasurementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $eventName;
    public $eventId;
    public $eventParams;
    public $clientId;
    public $userId;

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
     * @param array $eventParams
     * @param string|null $clientId
     * @param string|null $userId
     */
    public function __construct($eventName, $eventId, array $eventParams = [], $clientId = null, $userId = null)
    {
        $this->eventName = $eventName;
        $this->eventId = $eventId;
        $this->eventParams = $eventParams;
        $this->clientId = $clientId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = GA4MeasurementProtocolService::sendEvent(
            $this->eventName,
            $this->eventId,
            $this->eventParams,
            $this->clientId,
            $this->userId
        );

        if (!$result['success'] && $this->attempts() < $this->tries) {
            throw new \Exception("GA4 MP HTTP {$result['status']}: " . json_encode($result['response']));
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
        Log::error("SendGA4MeasurementJob permanently failed for {$this->eventName} ({$this->eventId}): " . $exception->getMessage());
    }
}
