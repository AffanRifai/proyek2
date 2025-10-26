<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Booking::with('car', 'user')->latest();

        // Filter by status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(10);
        $stats = $this->getBookingStats();

        // ✅ HANYA INFORMASI: Hitung booking yang sudah lewat tanggal (expired)
        $expiredCount = Booking::where('status', 'approved')
            ->where('sel_tgl', '<', Carbon::today())
            ->count();

        return view('admin.bookings.index', compact('bookings', 'stats', 'status', 'expiredCount'));
    }

    /**
     * ✅ FORM PENGEMBALIAN DENGAN DENDA FLEXIBLE
     */
    public function showFormPengembalian($id)
    {
        $booking = Booking::with('car')->findOrFail($id);

        // Default tanggal hari ini
        $defaultActualDate = now()->format('Y-m-d');

        // Hitung saran sistem (hanya sebagai referensi admin)
        $suggestedHariTerlambat = $booking->calculateSuggestedHariTerlambat($defaultActualDate);
        $suggestedDenda = $booking->calculateSuggestedDenda($defaultActualDate);

        return view('admin.bookings.pengembalian', compact(
            'booking',
            'suggestedHariTerlambat',
            'suggestedDenda'
        ));
    }

    /**
     * ✅ PROSES PENGEMBALIAN MANUAL DENGAN DENDA FLEXIBLE
     */
    public function prosesPengembalian(Request $request, $id)
    {
        $request->validate([
            'actual_sel_tgl' => 'required|date',
            'hari_terlambat' => 'required|integer|min:0',
            'denda_terlambat' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:500'
        ]);

        $booking = Booking::findOrFail($id);

        // ✅ Admin bebas tentukan hari terlambat & denda
        $booking->prosesPengembalianManual(
            $request->actual_sel_tgl,
            $request->hari_terlambat,
            $request->denda_terlambat,
            $request->catatan
        );

        $message = "✅ Mobil {$booking->car->merk} {$booking->car->model} telah dikembalikan.";
        if ($request->denda_terlambat > 0) {
            $message .= " Denda: Rp " . number_format($request->denda_terlambat, 0, ',', '.');
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', $message);
    }

    public function show($id)
    {
        $booking = Booking::with('car', 'user')->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if (!$booking->canBeApproved()) {
            return redirect()->back()
                ->with('error', 'Booking tidak dapat di-approve. Mobil mungkin sudah tidak tersedia.');
        }

        $booking->approve();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil di-approve!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:500'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->reject($request->alasan);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil di-reject!');
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:500'
        ]);

        $booking = Booking::findOrFail($id);

        try {
            $booking->cancel($request->alasan);
            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking berhasil dibatalkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    // Method complete tanpa denda (untuk pengembalian tepat waktu)
    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        try {
            $booking->complete();
            return redirect()->route('admin.bookings.index')
                ->with('success', 'Booking berhasil diselesaikan! Mobil dikembalikan tepat waktu.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Hapus file uploads
        Storage::disk('public')->delete([
            $booking->file_identitas,
            $booking->file_jaminan,
            $booking->file_stnk_motor
        ]);

        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    // View file
    public function viewFile($id, $type)
    {
        $booking = Booking::findOrFail($id);

        $filePath = null;
        $filename = '';

        switch ($type) {
            case 'identitas':
                $filePath = $booking->file_identitas;
                $filename = 'Identitas_' . $booking->nama_penyewa . '.pdf';
                break;
            case 'jaminan':
                $filePath = $booking->file_jaminan;
                $filename = 'Jaminan_' . $booking->nama_penyewa . '.pdf';
                break;
            case 'stnk':
                $filePath = $booking->file_stnk_motor;
                $filename = 'STNK_' . $booking->nama_penyewa . '.pdf';
                break;
            default:
                abort(404);
        }

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file(storage_path('app/public/' . $filePath));
    }

    // Download file
    public function downloadFile($id, $type)
    {
        $booking = Booking::findOrFail($id);

        $filePath = null;
        $filename = '';

        switch ($type) {
            case 'identitas':
                $filePath = $booking->file_identitas;
                $filename = 'Identitas_' . $booking->nama_penyewa . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            case 'jaminan':
                $filePath = $booking->file_jaminan;
                $filename = 'Jaminan_' . $booking->nama_penyewa . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            case 'stnk':
                $filePath = $booking->file_stnk_motor;
                $filename = 'STNK_' . $booking->nama_penyewa . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            default:
                abort(404);
        }

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($filePath, $filename);
    }

    // Statistics
    private function getBookingStats()
    {
        try {
            return [
                'total' => Booking::count(),
                'pending' => Booking::pending()->count(),
                'approved' => Booking::approved()->count(),
                'rejected' => Booking::rejected()->count(),
                'completed' => Booking::completed()->count(),
                'cancelled' => Booking::where('status', 'cancelled')->count(), // Pakai query langsung
            ];
        } catch (\Exception $e) {
            // Fallback jika ada error
            return [
                'total' => Booking::count(),
                'pending' => Booking::where('status', 'pending')->count(),
                'approved' => Booking::where('status', 'approved')->count(),
                'rejected' => Booking::where('status', 'rejected')->count(),
                'completed' => Booking::where('status', 'completed')->count(),
                'cancelled' => Booking::where('status', 'cancelled')->count(),
            ];
        }
    }
}
