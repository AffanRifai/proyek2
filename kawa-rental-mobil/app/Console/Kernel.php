<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // ✅ Sync payment status every 3 minutes
        $schedule->command('payment:sync')
                 ->everyThreeMinutes()
                 ->withoutOverlapping()
                 ->appendOutputTo(storage_path('logs/payment-sync.log'));

        // ✅ Clean up old logs daily
        $schedule->command('payment:sync-cleanup')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}