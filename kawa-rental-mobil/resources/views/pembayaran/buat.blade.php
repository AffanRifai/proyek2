@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@section('content')

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Pembayaran {{ ucfirst(str_replace('_', ' ', $jenis)) }}
                    </h1>
                    <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk melanjutkan proses booking</p>
                </div>

                <!-- Ringkasan Booking -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">📋 Ringkasan Booking</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">ID Transaksi</label>
                            <p class="font-semibold text-lg">{{ $booking->id_transaksi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Customer</label>
                            <p class="font-semibold">{{ $booking->nama_penyewa }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Mobil</label>
                            <p class="font-semibold">{{ $booking->car->merk }} {{ $booking->car->model }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Total Pembayaran</label>
                            <p class="font-semibold text-green-600 text-lg">Rp {{ number_format($jumlah, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    @if ($jenis == 'dp')
                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <p class="text-blue-800 text-sm">
                                    <strong>Pembayaran DP (20%)</strong> wajib dilakukan secara online via Midtrans
                                </p>
                            </div>
                        </div>
                    @elseif($jenis == 'bayar_penuh')
                        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <p class="text-blue-800 text-sm">
                                    <strong>Pembayaran Penuh</strong> wajib dilakukan secara online via Midtrans
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Pilihan Metode Pembayaran -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-800">💳 Pilih Metode Pembayaran</h2>

                    <!-- Pembayaran Online -->
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-wifi text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-green-700">Bayar Online</h3>
                        </div>

                        <form action="{{ route('pembayaran.proses.online', $booking->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis" value="{{ $jenis }}">
                            <button type="submit"
                                class="w-full bg-green-500 text-white py-4 rounded-lg hover:bg-green-600 transition duration-200 flex items-center justify-center">
                                <i class="fas fa-credit-card mr-3"></i>
                                @if ($jenis == 'dp')
                                    Bayar DP via Midtrans
                                @elseif($jenis == 'bayar_penuh')
                                    Bayar Penuh via Midtrans
                                @elseif($jenis == 'pelunasan')
                                    Lunasi via Midtrans
                                @elseif($jenis == 'denda')
                                    Bayar Denda via Midtrans
                                @endif
                            </button>
                        </form>

                        <div class="mt-3 text-sm text-gray-600">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Konfirmasi instan</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Berbagai metode pembayaran tersedia</span>
                            </div>
                        </div>
                    </div>

                        <!-- Info untuk DP & Bayar Penuh -->
                        <div class="border-t pt-8">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <i class="fas fa-store text-yellow-500 mr-3"></i>
                                    <div>
                                        <h3 class="font-semibold text-yellow-800">Pembayaran Offline</h3>
                                        <p class="text-yellow-700 text-sm mt-1">
                                            Untuk pembayaran <strong>{{ $jenis == 'dp' ? 'DP' : 'Bayar Penuh' }}</strong>,
                                            hanya tersedia metode pembayaran online via Midtrans untuk memastikan keamanan
                                            transaksi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <!-- Navigasi -->
                <div class="mt-6 text-center">
                    @auth

                        <!-- Untuk customer -->
                        <a href="{{ route('booking.show', $booking->id) }}"
                            class="text-blue-600 hover:text-blue-800 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Detail Booking
                        </a>

                    @endauth
                </div>
            </div>
        </div>
    </body>

@endsection
