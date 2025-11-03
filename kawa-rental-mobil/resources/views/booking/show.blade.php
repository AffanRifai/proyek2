<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Sistem Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Detail Booking Saya</h1>
                <p class="text-gray-600">ID Transaksi: <strong>{{ $booking->id_transaksi }}</strong></p>
            </div>

            <!-- Status Booking -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Status Booking</h2>
                        <p class="text-gray-600 mt-1">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $booking->status_badge }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-xl font-bold text-gray-800">Status Pembayaran</h2>
                        <p class="text-gray-600 mt-1">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold {{ $booking->badge_status_pembayaran }}">
                                {{ ucfirst( $booking->status_pembayaran) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informasi Booking -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Informasi Customer & Booking -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Informasi Customer</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm text-gray-600">Nama Penyewa</label>
                                <p class="font-semibold">{{ $booking->nama_penyewa }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">No. Telepon</label>
                                <p class="font-semibold">{{ $booking->no_telp }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Alamat</label>
                                <p class="font-semibold">{{ $booking->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Detail Booking</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm text-gray-600">Tanggal Mulai</label>
                                <p class="font-semibold">{{ $booking->mulai_tgl->format('d/m/Y') }}
                                    {{ $booking->mulai_pkl }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Tanggal Selesai</label>
                                <p class="font-semibold">{{ $booking->sel_tgl->format('d/m/Y') }}
                                    {{ $booking->sel_pkl }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Lama Sewa</label>
                                <p class="font-semibold">{{ $booking->lama_hari }} hari</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Tujuan</label>
                                <p class="font-semibold">{{ $booking->tujuan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Mobil & Pembayaran -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Informasi Mobil</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm text-gray-600">Merk & Model</label>
                                <p class="font-semibold">{{ $booking->car->merk }} {{ $booking->car->model }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">No. Polisi</label>
                                <p class="font-semibold">{{ $booking->car->no_polisi }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600">Biaya Harian</label>
                                <p class="font-semibold">Rp {{ number_format($booking->biaya_harian, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold mb-4 text-gray-800">Informasi Pembayaran</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm text-gray-600">Total Pembayaran</label>
                                <p class="font-semibold text-green-600">Rp
                                    {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                            </div>
                            @if ($booking->jumlah_dp > 0)
                                <div>
                                    <label class="block text-sm text-gray-600">DP Dibayar</label>
                                    <p class="font-semibold text-blue-600">Rp
                                        {{ number_format($booking->jumlah_dp, 0, ',', '.') }}</p>
                                </div>
                            @endif
                            @if ($booking->sisa_pembayaran > 0)
                                <div>
                                    <label class="block text-sm text-gray-600">Sisa Pembayaran</label>
                                    <p class="font-semibold text-orange-600">Rp
                                        {{ number_format($booking->sisa_pembayaran, 0, ',', '.') }}</p>

                                    <!-- Tombol Pelunasan -->
                                    @if ($booking->status_pembayaran == 'dp_dibayar')
                                        <a href="{{ route('pembayaran.buat', [$booking->id, 'pelunasan']) }}"
                                            class="mt-2 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 inline-block">
                                            <i class="fas fa-credit-card mr-2"></i>Lunasi Sekarang
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 text-center">
                <a href="{{ url('/landingpage') }}"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 inline-block">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>

                <a href="{{ route('bookings.saya') }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 inline-block ml-3">
                    <i class="fas fa-list mr-2"></i>Lihat Semua Booking
                </a>
            </div>
        </div>
    </div>
</body>

</html>
