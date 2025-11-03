@extends('layout.app')

@section('title', 'Pembayaran Tertunda')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <img src="{{ asset('assets/images/payment_pending.svg') }}" alt="Pending" style="max-width:180px;" class="mb-4">
        <h2 class="fw-bold text-warning">Pembayaran Tertunda</h2>
        <p class="text-muted mb-4">
            Pembayaran kamu sedang diproses oleh sistem Midtrans.<br>
            Silakan tunggu beberapa saat atau lakukan konfirmasi bila sudah melakukan transfer.
        </p>

        <div class="alert alert-warning shadow-sm mx-auto" style="max-width: 500px;">
            <strong>Status:</strong> Menunggu konfirmasi dari penyedia pembayaran.<br>
            Kamu akan menerima notifikasi setelah pembayaran berhasil.
        </div>

        <a href="{{ route('home') }}" class="btn btn-outline-warning mt-3 px-4">
            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
