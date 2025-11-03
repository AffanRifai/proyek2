<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Booking</h1>
                <p class="text-gray-600">ID Transaksi: <strong>{{ $booking->id_transaksi }}</strong></p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.bookings.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                @if ($booking->status == 'pending')
                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                            onclick="return confirm('Approve booking ini?')">
                            <i class="fas fa-check mr-2"></i>Approve
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Informasi Customer</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Nama Penyewa</label>
                            <p class="mt-1 text-lg font-semibold">{{ $booking->nama_penyewa }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">No. Telepon</label>
                            <p class="mt-1 text-lg font-semibold">{{ $booking->no_telp }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600">Alamat</label>
                            <p class="mt-1">{{ $booking->alamat }}</p>
                        </div>
                        @if ($booking->nama_supir)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Supir</label>
                                <p class="mt-1">{{ $booking->nama_supir }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Telp Supir</label>
                                <p class="mt-1">{{ $booking->telp_supir }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Booking Details -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Detail Booking</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tanggal Mulai</label>
                            <p class="mt-1">{{ $booking->mulai_tgl->format('d/m/Y') }} {{ $booking->mulai_pkl }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tanggal Selesai</label>
                            <p class="mt-1">{{ $booking->sel_tgl->format('d/m/Y') }} {{ $booking->sel_pkl }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Lama Sewa</label>
                            <p class="mt-1">{{ $booking->lama_hari }} hari</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tujuan</label>
                            <p class="mt-1">{{ $booking->tujuan }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Bentuk Jaminan</label>
                            <p class="mt-1">{{ ucfirst($booking->bentuk_jaminan) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Posisi BBM</label>
                            <p class="mt-1">{{ $booking->posisi_bbm }}</p>
                        </div>
                    </div>
                </div>

                <!-- Car Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Informasi Mobil</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Merk & Model</label>
                            <p class="mt-1 font-semibold">{{ $booking->car->merk }} {{ $booking->car->model }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">No. Polisi</label>
                            <p class="mt-1">{{ $booking->car->no_polisi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tahun</label>
                            <p class="mt-1">{{ $booking->car->tahun }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Warna</label>
                            <p class="mt-1">{{ $booking->car->warna }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Status Mobil</label>
                            <span
                                class="mt-1 px-2 py-1 text-xs rounded-full 
                                {{ $booking->car->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($booking->car->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Keterlambatan & Denda -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Informasi Keterlambatan & Denda</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Status Mobil</label>
                            <span
                                class="mt-1 px-3 py-1 rounded-full text-sm font-semibold {{ $booking->status_mobil_badge }}">
                                {{ ucfirst($booking->status_mobil) }}
                            </span>
                        </div>

                        @if ($booking->hari_terlambat > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Hari Terlambat</label>
                                <p class="mt-1 text-lg font-semibold text-red-600">
                                    {{ $booking->hari_terlambat }} hari
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600">Denda Terlambat</label>
                                <p class="mt-1 text-lg font-semibold text-red-600">
                                    Rp {{ number_format($booking->denda_terlambat, 0, ',', '.') }}
                                </p>
                            </div>
                        @endif

                        <div class="{{ $booking->hari_terlambat > 0 ? '' : 'md:col-span-2' }}">
                            <label class="block text-sm font-medium text-gray-600">Keterangan Terlambat</label>
                            <p class="mt-1 {{ $booking->keterangan_terlambat ? 'text-gray-800' : 'text-gray-400' }}">
                                {{ $booking->keterangan_terlambat ?: 'Tidak ada keterangan' }}
                            </p>
                        </div>

                        <!-- Catatan Admin (hanya tampil jika status cancelled) -->
                        @if ($booking->status == 'cancelled' && $booking->catatan_admin)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600">Catatan Admin
                                    (Pembatalan)</label>
                                <div class="mt-1 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-yellow-800">{{ $booking->catatan_admin }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Status & Payment -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Status & Pembayaran</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Status Booking</label>
                            <span
                                class="mt-1 px-3 py-1 rounded-full text-sm font-semibold {{ $booking->status_badge }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Status Real-time</label>
                            <span
                                class="mt-1 px-3 py-1 rounded-full text-sm font-semibold {{ $booking->status_utama_badge }}">
                                {{ $booking->status_utama['icon'] }} {{ $booking->status_utama['text'] }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">Tipe Pembayaran</label>
                            <p class="mt-1">{{ ucfirst($booking->tipe_pembayaran) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Biaya Harian</label>
                            <p class="mt-1">Rp {{ number_format($booking->biaya_harian, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Total Pembayaran</label>
                            <p class="mt-1 text-xl font-bold text-green-600">
                                Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Document Files -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Dokumen</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">File Identitas</label>
                            <div class="mt-1 flex space-x-2">
                                <a href="{{ route('admin.bookings.view-file', [$booking->id, 'identitas']) }}"
                                    target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                                <a href="{{ route('admin.bookings.download-file', [$booking->id, 'identitas']) }}"
                                    class="text-green-600 hover:text-green-900 text-sm">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">File Jaminan</label>
                            <div class="mt-1 flex space-x-2">
                                <a href="{{ route('admin.bookings.view-file', [$booking->id, 'jaminan']) }}"
                                    target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                                <a href="{{ route('admin.bookings.download-file', [$booking->id, 'jaminan']) }}"
                                    class="text-green-600 hover:text-green-900 text-sm">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </div>
                        </div>

                        @if ($booking->file_stnk_motor)
                            <div>
                                <label class="block text-sm font-medium text-gray-600">File STNK Motor</label>
                                <div class="mt-1 flex space-x-2">
                                    <a href="{{ route('admin.bookings.view-file', [$booking->id, 'stnk']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                    <a href="{{ route('admin.bookings.download-file', [$booking->id, 'stnk']) }}"
                                        class="text-green-600 hover:text-green-900 text-sm">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Admin Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Aksi Admin</h2>
                    <div class="space-y-2">
                        @if ($booking->status == 'pending')
                            <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 flex items-center justify-center">
                                    <i class="fas fa-check mr-2"></i>Approve Booking
                                </button>
                            </form>

                            <button onclick="showRejectModal()"
                                class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 flex items-center justify-center">
                                <i class="fas fa-times mr-2"></i>Tolak Booking
                            </button>
                        @endif

                        @if ($booking->status == 'approved')
                            <!-- ✅ TOMBOL COMPLETE MANUAL (untuk tepat waktu) -->
                            @if (!$booking->is_terlambat)
                                <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST"
                                    class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 flex items-center justify-center"
                                        onclick="return confirm('Tandai booking sebagai selesai? Mobil dikembalikan tepat waktu.')">
                                        <i class="fas fa-flag-checkered mr-2"></i>Tandai Selesai (Tepat Waktu)
                                    </button>
                                </form>
                            @endif

                            <!-- ✅ TOMBOL PENGEMBALIAN DENGAN DENDA (jika terlambat) -->
                            @if ($booking->tombol_pengembalian_aktif)
                                <a href="{{ route('admin.bookings.pengembalian', $booking->id) }}"
                                    class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 flex items-center justify-center">
                                    <i class="fas fa-car-side mr-2"></i>Proses Pengembalian (Terlambat)
                                </a>
                            @endif

                            <!-- Tombol Cancel -->
                            <button onclick="showCancelModal()"
                                class="w-full bg-gray-500 text-white py-2 rounded hover:bg-gray-600 flex items-center justify-center">
                                <i class="fas fa-ban mr-2"></i>Batalkan Booking
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-bold mb-4">Tolak Booking</h3>
            <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                    <textarea id="alasan" name="alasan" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Berikan alasan penolakan..."
                        required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideRejectModal()"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Tolak Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('alasan').value = '';
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideRejectModal();
            }
        });
    </script>
</body>

</html>
