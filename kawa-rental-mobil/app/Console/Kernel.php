<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // ✅ Tambahkan command auto-complete di sini
        Commands\AutoCompleteBookings::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // ✅ HYBRID: Scheduler untuk background processing
        $schedule->command('bookings:autocomplete')
                 ->dailyAt('06:00')
                 ->timezone('Asia/Jakarta')
                 ->appendOutputTo(storage_path('logs/scheduler.log'));

        // ✅ Juga run setiap 6 jam untuk redundancy
        $schedule->command('bookings:autocomplete')
                 ->everySixHours()
                 ->appendOutputTo(storage_path('logs/scheduler.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}