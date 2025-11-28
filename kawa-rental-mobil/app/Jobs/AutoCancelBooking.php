<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AutoCancelBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingId;

    /**
     * Create a new job instance.
     *
     * @param int $bookingId
     */
    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $booking = Booking::with('pembayaran', 'car')->find($this->bookingId);

        if (!$booking) {
            Log::warning("AutoCancelBooking: booking {$this->bookingId} not found.");
            return;
        }

        // already terminal?
        if (in_array($booking->status, ['expired', 'cancelled', 'rejected', 'completed'])) {
            Log::info("AutoCancelBooking: booking {$booking->id} status {$booking->status}, skip.");
            return;
        }

        // if payment succeeded, skip
        if ($booking->pembayaran()->where('status_pembayaran', 'sukses')->exists()) {
            Log::info("AutoCancelBooking: booking {$booking->id} has successful payment, skip.");
            return;
        }

        try {
            DB::transaction(function () use ($booking) {
                $booking->update([
                    'status' => 'expired',
                    'status_pembayaran' => 'tertunggak',
                    'catatan_admin' => 'Booking dibatalkan otomatis oleh sistem (job) karena tidak melakukan pembayaran.',
                ]);

                if ($booking->car) {
                    try {
                        $booking->car->update(['status' => 'tersedia']);
                    } catch (\Exception $e) {
                        Log::warning("AutoCancelBooking: failed to update car for booking {$booking->id}: " . $e->getMessage());
                    }
                }
            });

            Log::info("AutoCancelBooking: booking {$booking->id} auto-cancelled by job.");
        } catch (\Exception $e) {
            Log::error("AutoCancelBooking: error cancelling booking {$booking->id}: " . $e->getMessage());
            // thrown exceptions will mark job as failed/allow retry depending on queue config
            throw $e;
        }
    }
}
