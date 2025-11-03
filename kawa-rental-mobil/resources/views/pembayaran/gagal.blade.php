@extends('layouts.app')

@section('title', 'Pembayaran Gagal')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <img src="{{ asset('assets/images/payment_failed.svg') }}" alt="Gagal" style="max-width:180px;" class="mb-4">
        <h2 class="fw-bold text-danger">Pembayaran Gagal</h2>
        <p class="text-muted mb-4">
            Maaf, pembayaran kamu tidak dapat diproses. Mungkin terjadi kesalahan atau transaksi dibatalkan.
        </p>

        <div class="alert alert-danger shadow-sm mx-auto" style="max-width: 500px;">
            <strong>Detail:</strong> Pembayaran gagal diproses oleh Midtrans.<br>
            Silakan coba lagi atau hubungi admin untuk bantuan lebih lanjut.
        </div>

        <a href="{{ route('booking.form') }}" class="btn btn-outline-danger mt-3 px-4">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Form Booking
        </a>
    </div>
</div>
@endsection
