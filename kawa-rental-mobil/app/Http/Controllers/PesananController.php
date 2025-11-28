<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // filter status (booking/status_pembayaran)
        $filter_status = $request->query('status'); // e.g. pending, approved, completed, cancelled
        $filter_payment = $request->query('payment'); // e.g. menunggu, dp_dibayar, lunas

        $query = Booking::with(['car', 'pembayaran'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        if ($filter_status) {
            $query->where('status', $filter_status);
        }

        if ($filter_payment) {
            $query->where('status_pembayaran', $filter_payment);
        }

        // pagination 10 per page
        $bookings = $query->paginate(10)->withQueryString();

        // untuk menampilkan counts untuk filter (optional)
        $counts = [
            'all' => Booking::where('user_id', $user->id)->count(),
            'pending' => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
            'approved' => Booking::where('user_id', $user->id)->where('status', 'approved')->count(),
            'cancelled' => Booking::where('user_id', $user->id)->where('status', 'cancelled')->count(),
            'lunas' => Booking::where('user_id', $user->id)->where('status_pembayaran', 'lunas')->count(),
            'menunggu' => Booking::where('user_id', $user->id)->where('status_pembayaran', 'menunggu')->count(),
        ];

        return view('customer.pesanan', compact('bookings', 'counts', 'filter_status', 'filter_payment'));
    }

    public function show($id)
    {
        $booking = Booking::with(['car', 'pembayaran'])->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak punya akses ke pesanan ini.');
        }

        return view('customer.detail_pesanan', compact('booking'));
    }

    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!$booking->isCancelable()) {
            return response()->json(['message' => 'Pesanan tidak dapat dibatalkan'], 422);
        }

        DB::beginTransaction();
        try {
            $booking->status = 'cancelled';
            $booking->status_pembayaran = 'tertunggak'; // atau tetap 'menunggu' — pilih sesuai kebijakan
            $booking->save();

            // jika ada pembayaran menunggu, bisa otomatis tandai sebagai gagal/kadaluarsa jika ingin
            // $booking->pembayaran()->where('status_pembayaran', 'menunggu')->update(['status_pembayaran' => 'kadaluarsa']);

            DB::commit();
            return response()->json(['message' => 'Pesanan dibatalkan'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal membatalkan pesanan'], 500);
        }
    }
}
