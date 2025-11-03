<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sukses - Kawa Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center px-4 py-10">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-lg p-8 text-center relative overflow-hidden">
        <!-- Background Decorative -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 via-teal-400 to-blue-500"></div>

        <!-- Success Icon -->
        <div class="flex justify-center mb-6 mt-4">
            <div
                class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg transform transition-all hover:scale-110">
                <i class="fas fa-check text-white text-4xl animate-bounce"></i>
            </div>
        </div>

        <!-- Success Title -->
        <h1 class="text-2xl font-extrabold text-gray-800 mb-2">
            @if ($pembayaran->jenis_pembayaran == 'dp')
                Pembayaran DP Berhasil!
            @elseif($pembayaran->jenis_pembayaran == 'pelunasan')
                Pelunasan Berhasil!
            @elseif($pembayaran->jenis_pembayaran == 'bayar_penuh')
                Pembayaran Penuh Berhasil!
            @else
                Pembayaran Berhasil!
            @endif
        </h1>
        <p class="text-gray-600 mb-6">Terima kasih telah melakukan pembayaran. Berikut detail transaksi Anda:</p>

        <!-- Payment Details Card -->
        <div class="bg-gray-50 rounded-xl shadow-inner p-5 mb-6 text-left border border-gray-100">
            <h2 class="text-lg font-bold mb-3 text-gray-800 border-b pb-2">Detail Pembayaran</h2>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID Transaksi</span>
                    <span class="font-semibold text-gray-800">{{ $pembayaran->booking->id_transaksi }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jenis Pembayaran</span>
                    <span
                        class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $pembayaran->jenis_pembayaran)) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jumlah</span>
                    <span class="font-semibold text-green-600">
                        Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Status Pembayaran</span>
                    <span
                        class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $pembayaran->booking->status_pembayaran == 'dp_dibayar' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                        {{ $pembayaran->booking->status_pembayaran == 'dp_dibayar' ? 'DP Dibayar' : 'Lunas' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Booking Status -->
        <div class="bg-white border border-green-200 rounded-xl p-5 shadow-sm mb-6">
            <h3 class="text-green-700 font-semibold mb-3 flex items-center">
                <i class="fas fa-clipboard-check mr-2"></i>Status Booking
            </h3>

            <div class="grid grid-cols-1 gap-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Status Pembayaran</span>
                    <span class="font-semibold">
                        @if ($pembayaran->booking->status_pembayaran == 'lunas')
                            ✅ Lunas
                        @elseif($pembayaran->booking->status_pembayaran == 'dp_dibayar')
                            ⏳ DP Dibayar
                        @else
                            {{ ucfirst($pembayaran->booking->status_pembayaran) }}
                        @endif
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Total Dibayar</span>
                    <span class="font-semibold text-green-600">
                        Rp {{ number_format($pembayaran->booking->total_dibayar, 0, ',', '.') }}
                    </span>
                </div>

                @if ($pembayaran->booking->sisa_pembayaran > 0)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sisa Pembayaran</span>
                        <span class="font-semibold text-orange-500">
                            Rp {{ number_format($pembayaran->booking->sisa_pembayaran, 0, ',', '.') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-3">
            <a href="{{ route('booking.show', $pembayaran->booking_id) }}"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center gap-2 shadow">
                <i class="fas fa-eye"></i> Lihat Detail Booking
            </a>

            <a href="{{ url('landingpage') }}"
                class="w-full bg-gray-500 text-white py-3 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center justify-center gap-2">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Footer Note -->
        <p class="text-xs text-gray-400 mt-8">© {{ date('Y') }} Kawa Rental Mobil. Semua Hak Dilindungi.</p>
    </div>

</body>

</html>
