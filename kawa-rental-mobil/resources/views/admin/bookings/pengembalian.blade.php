<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pengembalian - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Proses Pengembalian Mobil</h1>
                <a href="{{ route('admin.bookings.index') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            <!-- Booking Info -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Informasi Booking</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">ID Transaksi</label>
                        <p class="font-semibold">{{ $booking->id_transaksi }}</p>
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
                        <label class="block text-sm font-medium text-gray-600">No. Polisi</label>
                        <p>{{ $booking->car->no_polisi }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Selesai (Rencana)</label>
                        <p>{{ $booking->sel_tgl->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Biaya Harian</label>
                        <p>Rp {{ number_format($booking->biaya_harian, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Saran Sistem (Optional) -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <h3 class="text-lg font-bold text-blue-800 mb-2">
                    <i class="fas fa-robot mr-2"></i>Saran Sistem
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Tanggal pengembalian hari ini:</span>
                        <span>{{ date('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Saran hari terlambat:</span>
                        <span>{{ $suggestedHariTerlambat }} hari</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Saran denda (150% per hari):</span>
                        <span>Rp {{ number_format($suggestedDenda, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-blue-600 text-xs mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Saran ini hanya referensi. Admin dapat menyesuaikan sesuai kebijakan.
                    </div>
                </div>
            </div>

            <!-- Form Pengembalian Flexible -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Form Pengembalian</h2>
                <form action="{{ route('admin.bookings.proses-pengembalian', $booking->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="actual_sel_tgl" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Actual Pengembalian *
                        </label>
                        <input type="date" id="actual_sel_tgl" name="actual_sel_tgl"
                            value="{{ old('actual_sel_tgl', date('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required onchange="updateSaran()">
                    </div>

                    <!-- Input Flexible untuk Admin -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="hari_terlambat" class="block text-sm font-medium text-gray-700 mb-2">
                                Hari Terlambat *
                            </label>
                            <input type="number" id="hari_terlambat" name="hari_terlambat"
                                value="{{ old('hari_terlambat', $suggestedHariTerlambat) }}" min="0"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required onchange="hitungDenda()">
                        </div>

                        <div>
                            <label for="denda_terlambat" class="block text-sm font-medium text-gray-700 mb-2">
                                Denda Terlambat (Rp) *
                            </label>
                            <input type="number" id="denda_terlambat" name="denda_terlambat"
                                value="{{ old('denda_terlambat', $suggestedDenda) }}" min="0" step="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required onchange="updateSummary()">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Pengembalian
                        </label>
                        <textarea id="catatan" name="catatan" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tambahkan catatan kebijakan denda atau alasan penyesuaian...">{{ old('catatan') }}</textarea>
                    </div>

                    <!-- Summary -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="font-bold mb-2">Ringkasan Pembayaran</h3>
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span>Total Sewa:</span>
                                <span>Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Denda Keterlambatan:</span>
                                <span class="text-red-600">Rp <span id="displayDenda">0</span></span>
                            </div>
                            <div class="flex justify-between border-t border-gray-300 pt-2">
                                <span class="font-bold">Total yang Harus Dibayar:</span>
                                <span class="font-bold text-green-600">
                                    Rp <span id="displayTotal">0</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.bookings.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 flex items-center">
                            <i class="fas fa-check mr-2"></i>Proses Pengembalian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update summary secara real-time
        function updateSummary() {
            const denda = parseInt(document.getElementById('denda_terlambat').value) || 0;
            const totalSewa = {{ $booking->total_pembayaran }};

            document.getElementById('displayDenda').textContent = denda.toLocaleString('id-ID');
            document.getElementById('displayTotal').textContent = (totalSewa + denda).toLocaleString('id-ID');
        }

        // Hitung denda otomatis berdasarkan hari terlambat (optional)
        function hitungDenda() {
            const hariTerlambat = parseInt(document.getElementById('hari_terlambat').value) || 0;
            const biayaHarian = {{ $booking->biaya_harian }};
            const dendaOtomatis = hariTerlambat * (biayaHarian * 1.5);

            // Isi otomatis, tapi admin bisa edit manual
            document.getElementById('denda_terlambat').value = dendaOtomatis;
            updateSummary();
        }

        // Update saran ketika tanggal berubah
        function updateSaran() {
            // Bisa ditambahkan AJAX call untuk hitung saran berdasarkan tanggal
            updateSummary();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateSummary();
        });
    </script>
</body>

</html>
