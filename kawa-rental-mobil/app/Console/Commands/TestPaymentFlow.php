<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Pembayaran;

class TestPaymentFlow extends Command
{
    protected $signature = 'payment:test {booking_id} {jenis}';
    protected $description = 'Test payment flow automatically';

    public function handle()
    {
        $bookingId = $this->argument('booking_id');
        $jenis = $this->argument('jenis');

        try {
            $booking = Booking::findOrFail($bookingId);

            $this->info("Testing Payment Flow:");
            $this->info("Booking ID: {$booking->id}");
            $this->info("Transaction ID: {$booking->id_transaksi}");
            $this->info("Jenis Pembayaran: {$jenis}");
            $this->info("Total: Rp " . number_format($booking->total_pembayaran, 0, ',', '.'));

            // Cek jika sudah ada pembayaran
            $existingPayment = Pembayaran::where('booking_id', $bookingId)
                ->where('jenis_pembayaran', $jenis)
                ->first();

            if ($existingPayment) {
                $this->info("Existing Payment Found:");
                $this->info(" - Status: {$existingPayment->status_pembayaran}");
                $this->info(" - Amount: Rp " . number_format($existingPayment->jumlah, 0, ',', '.'));
            } else {
                $this->info("No existing payment found");
            }

            $this->info("\nTest URL: http://127.0.0.1:8000/test-payment-flow/{$bookingId}/{$jenis}");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
