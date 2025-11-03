<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class PaymentSyncCleanup extends Command
{
    protected $signature = 'payment:sync-cleanup';
    protected $description = 'Clean up old sync data and logs';

    public function handle()
    {
        $this->info('🧹 Cleaning up payment sync data...');

        // Delete successful payments older than 30 days from sync log
        $deleted = Pembayaran::where('status_pembayaran', 'sukses')
            ->where('updated_at', '<', now()->subDays(30))
            ->delete();

        $this->info("Deleted {$deleted} old successful payments from log");

        // Clean up laravel log file (keep last 1MB)
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile) && filesize($logFile) > 1024 * 1024) { // 1MB
            file_put_contents($logFile, '');
            $this->info('Cleared laravel.log file');
        }

        $this->info('🎉 Cleanup completed!');
        return Command::SUCCESS;
    }
}