<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Car;
use Carbon\Carbon;

class UpdateCarStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $cars = Car::all();

        foreach ($cars as $car) {
            $car->updateStatusBasedOnBookings();
        }

        \Log::info('Car statuses updated successfully at ' . now());
    }
}
