<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Back\TrackingRepository;
use App\Models\TrackingSetting;

class PruneTrackingLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking:prune {--days= : Number of days of logs to retain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune old tracking event logs based on retention settings';

    /**
     * Execute the console command.
     *
     * @param TrackingRepository $repository
     * @return int
     */
    public function handle(TrackingRepository $repository)
    {
        $days = $this->option('days') ?: TrackingSetting::get('log_retention_days', 30);
        $deleted = $repository->pruneLogs($days);

        $this->info("Successfully pruned {$deleted} tracking log entries older than {$days} days.");
        return 0;
    }
}
