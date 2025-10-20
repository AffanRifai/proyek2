@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Pesanan Anda</h2>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Mobil</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->car->nama }}</td>
                    <td>{{ $booking->mulai_tgl }} s/d {{ $booking->sel_tgl }}</td>
                    <td>Rp{{ number_format($booking->total_pembayaran, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada pesanan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
