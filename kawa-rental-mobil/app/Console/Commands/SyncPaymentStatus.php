<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class SyncPaymentStatus extends Command
{
    protected $signature = 'payment:sync 
                            {--all : Sync all pending payments}
                            {--hours=24 : Sync payments from last X hours}
                            {paymentId?}';

    protected $description = 'Sync payment status from Midtrans';

    public function handle()
    {
        $this->info('🔄 Starting payment status sync from Midtrans...');

        // Initialize Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        try {
            // Get payments to sync
            $payments = $this->getPaymentsToSync();
            $this->info("📊 Found {$payments->count()} payments to sync");

            $successCount = 0;
            $errorCount = 0;

            foreach ($payments as $payment) {
                if ($this->syncSinglePayment($payment)) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            $this->info("🎉 Sync completed! Success: {$successCount}, Errors: {$errorCount}");

            Log::info("Payment sync completed", [
                'success_count' => $successCount,
                'error_count' => $errorCount,
                'total' => $payments->count()
            ]);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("❌ Sync failed: " . $e->getMessage());
            Log::error("Payment sync failed: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function getPaymentsToSync()
    {
        $query = Pembayaran::where('status_pembayaran', 'menunggu')
            ->whereNotNull('midtrans_order_id');

        if ($this->option('all')) {
            return $query->get();
        }

        if ($this->argument('paymentId')) {
            return Pembayaran::where('id', $this->argument('paymentId'))->get();
        }

        $hours = $this->option('hours');
        return $query->where('created_at', '>=', now()->subHours($hours))->get();
    }

    private function syncSinglePayment($payment)
    {
        try {
            $this->info("🔍 Checking payment ID: {$payment->id}, Order: {$payment->midtrans_order_id}");

            // Get status from Midtrans
            $status = \Midtrans\Transaction::status($payment->midtrans_order_id);

            $this->info("📈 Midtrans status: {$status->transaction_status}");

            // Process based on status
            if (in_array($status->transaction_status, ['settlement', 'capture'])) {
                return $this->processSuccessfulPayment($payment, $status);
            } else {
                $this->info("⏳ Payment {$payment->id} still {$status->transaction_status}");
                return true; // Not an error, just pending
            }
        } catch (\Exception $e) {
            $this->error("❌ Payment {$payment->id} error: " . $e->getMessage());
            Log::error("Sync error for payment {$payment->id}: " . $e->getMessage());
            return false;
        }
    }

    private function processSuccessfulPayment($payment, $status)
    {
        return DB::transaction(function () use ($payment, $status) {
            // Update payment
            $payment->update([
                'status_pembayaran' => 'sukses',
                'jumlah_dibayar' => $status->gross_amount,
                'midtrans_transaction_id' => $status->transaction_id,
                'dibayar_pada' => now(),
                'data_pembayaran' => json_encode($status)
            ]);

            // Update booking
            $booking = $payment->booking;
            switch ($payment->jenis_pembayaran) {
                case 'dp':
                    $booking->update([
                        'status_pembayaran' => 'dp_dibayar',
                        'jumlah_dp' => $status->gross_amount,
                        'sisa_pembayaran' => $booking->total_pembayaran - $status->gross_amount,
                        'total_dibayar' => $status->gross_amount
                    ]);
                    break;

                case 'pelunasan':
                    $booking->update([
                        'status_pembayaran' => 'lunas',
                        'sisa_pembayaran' => 0,
                        'total_dibayar' => $booking->total_dibayar + $status->gross_amount
                    ]);
                    break;

                case 'bayar_penuh':
                    $booking->update([
                        'status_pembayaran' => 'lunas',
                        'total_dibayar' => $status->gross_amount,
                        'sisa_pembayaran' => 0,
                        'jumlah_dp' => 0
                    ]);
                    break;
            }

            $this->info("✅ SUCCESS: Payment {$payment->id} updated to sukses");
            Log::info("Payment synced successfully", [
                'payment_id' => $payment->id,
                'order_id' => $payment->midtrans_order_id,
                'status' => $status->transaction_status,
                'amount' => $status->gross_amount
            ]);

            return true;
        });
    }
}
