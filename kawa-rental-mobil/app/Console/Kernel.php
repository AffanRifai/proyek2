<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\AutoCompleteBookings::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // // ✅ Sync payment status every 3 minutes
        // $schedule->command('payment:sync')
        //     ->everyThreeMinutes()
        //     ->withoutOverlapping()
        //     ->appendOutputTo(storage_path('logs/payment-sync.log'));

        // // ✅ Clean up old logs daily
        // $schedule->command('payment:sync-cleanup')->daily();

    }



    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,

            // Tambahkan di bawah sini
            \App\Http\Middleware\AutoCancelMiddleware::class,

            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}
