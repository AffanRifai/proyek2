@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@section('content')

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto text-center">
                <!-- Header -->
                <div class="mb-8">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-credit-card text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran via Midtrans</h1>
                    <p class="text-gray-600">Selesaikan pembayaran Anda dengan aman</p>
                </div>

                <!-- Info Booking -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <label class="block text-sm text-gray-600">ID Transaksi</label>
                            <p class="font-semibold">{{ $booking->id_transaksi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600">Jenis Pembayaran</label>
                            <p class="font-semibold text-green-600">
                                {{ ucfirst(str_replace('_', ' ', $pembayaran->jenis_pembayaran)) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600">Jumlah</label>
                            <p class="font-semibold">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600">Status</label>
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Pembayaran
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Container Midtrans -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-bold mb-4 text-gray-800">Pilih Metode Pembayaran</h2>
                    <div id="midtrans-payment-container" class="min-h-[400px] flex items-center justify-center">
                        <div class="text-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500 mx-auto mb-4"></div>
                            <p class="text-gray-600">Memuat halaman pembayaran...</p>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <div class="text-left">
                            <p class="text-blue-800 text-sm">
                                <strong>Pembayaran Aman:</strong> Transaksi diproses oleh Midtrans dengan standar keamanan
                                tinggi.
                                Pilih metode pembayaran yang tersedia untuk menyelesaikan transaksi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="mt-6">
                    <a href="{{ route('booking.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Detail Booking
                    </a>
                </div>
            </div>
        </div>

        <!-- Midtrans Snap JS -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('payment.sukses', $pembayaran->id) }}';
                },
                onPending: function(result) {
                    window.location.href = '{{ route('payment.pending', $pembayaran->id) }}';
                },
                onError: function(result) {
                    window.location.href = '{{ route('payment.gagal', $pembayaran->id) }}';
                }
            });
        </script>
    </body>

@endsection
