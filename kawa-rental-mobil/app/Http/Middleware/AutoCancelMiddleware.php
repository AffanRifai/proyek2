<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Booking;

class AutoCancelMiddleware
{
    public function handle($request, Closure $next)
    {
        // Ambil semua booking pending
        $bookings = Booking::where('status_sewa', 'status_pembayaran')->get();

        foreach ($bookings as $booking) {
            // Jalankan cek otomatis
            if (method_exists($booking, 'checkAutoCancel')) {
                $booking->checkAutoCancel();
            }
        }

        return $next($request);
    }
}
