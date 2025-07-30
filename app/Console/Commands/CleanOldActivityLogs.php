<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanOldActivityLogs extends Command
{
    protected $signature = 'activitylog:clean-batch';

    protected $description = 'Delete old activity logs in batches to avoid memory exhaustion';

    public function handle()
    {
        $cutoffDate = now()->subDays(30);
        $batchSize = 500;
        $totalDeleted = 0;

        do {
            $deleted = DB::table('activity_log')
                ->where('created_at', '<', $cutoffDate)
                ->limit($batchSize)
                ->delete();

            $totalDeleted += $deleted;

            $this->info("Deleted batch of {$deleted} records...");
        } while ($deleted > 0);

        $this->info("Cleanup finished. Total deleted: {$totalDeleted}");
    }
}
