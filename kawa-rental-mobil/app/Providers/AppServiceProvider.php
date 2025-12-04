<?php

namespace App\Providers;

use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        // atur session timezone ke +07:00 (Jakarta)
        try {
            DB::statement("SET time_zone = '+07:00'");
        } catch (\Exception $e) {
            Log::warning('Could not set DB time_zone: ' . $e->getMessage());
        }

        if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // true kalau udah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
