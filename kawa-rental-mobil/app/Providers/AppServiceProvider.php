<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Midtrans\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot()
    {
        if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // true kalau udah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
