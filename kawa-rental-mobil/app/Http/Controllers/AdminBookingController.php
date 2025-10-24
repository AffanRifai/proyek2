<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.bookings.index', compact('bookings', 'stats', 'status'));
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

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->complete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diselesaikan!');
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
        return [
            'total' => Booking::count(),
            'pending' => Booking::pending()->count(),
            'approved' => Booking::approved()->count(),
            'rejected' => Booking::rejected()->count(),
            'completed' => Booking::completed()->count(),
        ];
    }
}