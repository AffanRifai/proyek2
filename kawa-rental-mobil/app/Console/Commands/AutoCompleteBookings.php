<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Illuminate\Container\Attributes\Log;


class AutoCompleteBookings extends Command
{
    protected $signature = 'bookings:autocomplete';
    protected $description = 'Automatically complete expired bookings';

    public function handle()
    {
        $expiredBookings = Booking::expiredUnpaid()->get();

        if ($expiredBookings->isEmpty()) {
            $this->info('Tidak ada booking yang perlu dibatalkan.');
            return Command::SUCCESS;
        }

        foreach ($expiredBookings as $booking) {
            $booking->update([
                'status' => 'cancelled',
                'status_pembayaran' => 'tertunggak',
                'catatan_admin' => 'Booking otomatis dibatalkan karena tidak dibayar dalam 1x24 jam.',
            ]);
        }

        $this->info("{$expiredBookings->count()} booking dibatalkan otomatis.");
        return Command::SUCCESS;
    }
}
