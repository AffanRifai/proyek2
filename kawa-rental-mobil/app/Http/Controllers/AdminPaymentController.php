<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        // Filter parameters
        $status = $request->get('status', 'all');
        $jenis = $request->get('jenis', 'all');
        $search = $request->get('search');

        // Query payments dengan relasi
        $query = Pembayaran::with(['booking', 'booking.car', 'booking.user'])
            ->latest();

        // Filter status
        if ($status !== 'all') {
            $query->where('status_pembayaran', $status);
        }

        // Filter jenis pembayaran
        if ($jenis !== 'all') {
            $query->where('jenis_pembayaran', $jenis);
        }

        // Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('midtrans_order_id', 'like', "%{$search}%")
                    ->orWhereHas('booking', function ($q) use ($search) {
                        $q->where('id_transaksi', 'like', "%{$search}%")
                            ->orWhere('nama_penyewa', 'like', "%{$search}%");
                    });
            });
        }

        $payments = $query->paginate(20);

        // Statistics
        $stats = $this->getPaymentStats();

        return view('admin.payments.index', compact('payments', 'stats', 'status', 'jenis', 'search'));
    }

    public function show($id)
    {
        $payment = Pembayaran::with(['booking', 'booking.car', 'booking.user'])->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    public function manualSync($id)
    {
        try {
            $payment = Pembayaran::findOrFail($id);

            Artisan::call('payment:sync', ['paymentId' => $id]);
            $output = Artisan::output();

            return redirect()->route('admin.payments.show', $id)
                ->with('success', 'Manual sync completed: ' . strip_tags($output));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Pembayaran::findOrFail($id);

            \Log::info("Admin deleting payment", [
                'payment_id' => $payment->id,
                'order_id' => $payment->midtrans_order_id,
                'admin_id' => auth()->id()
            ]);

            $payment->delete();

            return redirect()->route('admin.payments.index')
                ->with('success', 'Pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error("Failed to delete payment {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus pembayaran: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:sukses,menunggu,gagal',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        try {
            $payment = Pembayaran::findOrFail($id);

            DB::transaction(function () use ($payment, $request) {
                $oldStatus = $payment->status_pembayaran;
                $newStatus = $request->status_pembayaran;

                $payment->update([
                    'status_pembayaran' => $newStatus,
                    'catatan_admin' => $request->catatan_admin
                ]);

                // Jika status berubah ke sukses, update booking juga
                if ($newStatus === 'sukses' && $oldStatus !== 'sukses') {
                    $this->updateBookingPaymentStatus($payment);
                }

                \Log::info("Admin manually updated payment status", [
                    'payment_id' => $payment->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                    'admin_id' => auth()->id()
                ]);
            });

            return redirect()->route('admin.payments.show', $id)
                ->with('success', 'Status pembayaran berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:sync_selected,delete_selected',
            'selected_payments' => 'required|array'
        ]);

        try {
            if ($request->action === 'sync_selected') {
                $successCount = 0;
                foreach ($request->selected_payments as $paymentId) {
                    try {
                        Artisan::call('payment:sync', ['paymentId' => $paymentId]);
                        $successCount++;
                    } catch (\Exception $e) {
                        \Log::error("Bulk sync failed for payment {$paymentId}: " . $e->getMessage());
                    }
                }

                return redirect()->route('admin.payments.index')
                    ->with('success', "Berhasil sync {$successCount} pembayaran!");
            } elseif ($request->action === 'delete_selected') {
                Pembayaran::whereIn('id', $request->selected_payments)->delete();

                return redirect()->route('admin.payments.index')
                    ->with('success', 'Pembayaran terpilih berhasil dihapus!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Bulk action failed: ' . $e->getMessage());
        }
    }

    private function getPaymentStats()
    {
        return [
            'total' => Pembayaran::count(),
            'sukses' => Pembayaran::where('status_pembayaran', 'sukses')->count(),
            'menunggu' => Pembayaran::where('status_pembayaran', 'menunggu')->count(),
            'gagal' => Pembayaran::where('status_pembayaran', 'gagal')->count(),

            'total_amount' => Pembayaran::where('status_pembayaran', 'sukses')->sum('jumlah_dibayar'),
            'dp_count' => Pembayaran::where('jenis_pembayaran', 'dp')->where('status_pembayaran', 'sukses')->count(),
            'pelunasan_count' => Pembayaran::where('jenis_pembayaran', 'pelunasan')->where('status_pembayaran', 'sukses')->count(),
            'full_count' => Pembayaran::where('jenis_pembayaran', 'bayar_penuh')->where('status_pembayaran', 'sukses')->count(),
        ];
    }

    private function updateBookingPaymentStatus($payment)
    {
        $booking = $payment->booking;

        switch ($payment->jenis_pembayaran) {
            case 'dp':
                $booking->update([
                    'status_pembayaran' => 'dp_dibayar',
                    'jumlah_dp' => $payment->jumlah_dibayar,
                    'sisa_pembayaran' => $booking->total_pembayaran - $payment->jumlah_dibayar,
                    'total_dibayar' => $payment->jumlah_dibayar
                ]);
                break;

            case 'pelunasan':
                $booking->update([
                    'status_pembayaran' => 'lunas',
                    'sisa_pembayaran' => 0,
                    'total_dibayar' => $booking->total_dibayar + $payment->jumlah_dibayar
                ]);
                break;

            case 'bayar_penuh':
                $booking->update([
                    'status_pembayaran' => 'lunas',
                    'total_dibayar' => $payment->jumlah_dibayar,
                    'sisa_pembayaran' => 0,
                    'jumlah_dp' => 0
                ]);
                break;
        }
    }
}
