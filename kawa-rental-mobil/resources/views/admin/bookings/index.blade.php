<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        <!-- Header Simple -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Booking</h1>
                <p class="text-gray-600 mt-1">
                    @if ($expiredCount > 0)
                        <span class="text-orange-600 font-semibold">
                            ⚠️ Ada {{ $expiredCount }} booking yang sudah lewat tanggal selesai
                        </span>
                    @else
                        <span class="text-green-600">✅ Semua booking dalam kondisi normal</span>
                    @endif
                </p>
            </div>

            <div class="flex space-x-2">
                <!-- Refresh Page -->
                <a href="{{ route('admin.bookings.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 flex items-center">
                    <i class="fas fa-redo mr-2"></i>Refresh
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] ?? 0 }}</div>
                <div class="text-gray-600">Total Booking</div>
            </div>
            <div class="bg-yellow-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-yellow-800">{{ $stats['pending'] ?? 0 }}</div>
                <div class="text-yellow-600">Pending</div>
            </div>
            <div class="bg-green-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-green-800">{{ $stats['approved'] ?? 0 }}</div>
                <div class="text-green-600">Approved</div>
            </div>
            <div class="bg-red-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-red-800">{{ $stats['rejected'] ?? 0 }}</div>
                <div class="text-red-600">Rejected</div>
            </div>
            <div class="bg-blue-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-blue-800">{{ $stats['completed'] ?? 0 }}</div>
                <div class="text-blue-600">Completed</div>
            </div>
            <div class="bg-gray-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['cancelled'] ?? 0 }}</div>
                <div class="text-gray-600">Cancelled</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex space-x-4">
                <a href="{{ route('admin.bookings.index', ['status' => 'all']) }}"
                    class="px-4 py-2 rounded {{ $status == 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Semua
                </a>
                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded {{ $status == 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Pending
                </a>
                <a href="{{ route('admin.bookings.index', ['status' => 'approved']) }}"
                    class="px-4 py-2 rounded {{ $status == 'approved' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Approved
                </a>
                <a href="{{ route('admin.bookings.index', ['status' => 'rejected']) }}"
                    class="px-4 py-2 rounded {{ $status == 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Rejected
                </a>
                <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}"
                    class="px-4 py-2 rounded {{ $status == 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Completed
                </a>
                <a href="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}"
                    class="px-4 py-2 rounded {{ $status == 'cancelled' ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    Cancelled
                </a>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Transaksi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mobil
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Periode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->id_transaksi }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->created_at->format('d/m/Y H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->nama_penyewa }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->no_telp }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $booking->car->merk }} {{ $booking->car->model }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $booking->car->no_polisi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $booking->mulai_tgl->format('d/m/Y') }} -
                                    {{ $booking->sel_tgl->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $booking->lama_hari }} hari</div>

                                <!-- Info Expired -->
                                @if ($booking->isExpired())
                                    <div class="text-xs text-red-600 font-semibold mt-1">
                                        ⚠️ Sudah lewat tanggal selesai
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-500">{{ ucfirst($booking->tipe_pembayaran) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-2">
                                    <!-- Status Booking (Pending/Approved/Completed/etc) -->
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status_badge }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                    <!-- Status Mobil (Hanya tampil jika bukan normal) -->
                                    @if ($booking->status_mobil != 'normal')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status_mobil_badge }}">
                                            {{ ucfirst($booking->status_mobil) }}
                                        </span>
                                    @endif

                                    <!-- Denda Info (Hanya tampil jika ada denda) -->
                                    @if ($booking->ada_denda)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Denda: Rp {{ number_format($booking->denda_terlambat, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <!-- Tombol Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>

                                    @if ($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.approve', $booking->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900"
                                                onclick="return confirm('Approve booking ini?')">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>

                                        <button type="button" onclick="showRejectModal({{ $booking->id }})"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    @endif

                                    @if ($booking->status == 'approved')
                                        <!-- ✅ TOMBOL COMPLETE MANUAL (untuk pengembalian tepat waktu) -->
                                        @if (!$booking->is_terlambat)
                                            <form action="{{ route('admin.bookings.complete', $booking->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-900"
                                                    onclick="return confirm('Tandai booking sebagai selesai? Mobil dikembalikan tepat waktu.')">
                                                    <i class="fas fa-flag-checkered mr-1"></i> Complete
                                                </button>
                                            </form>
                                        @endif

                                        <!-- ✅ TOMBOL PENGEMBALIAN DENGAN DENDA (hanya tampil jika terlambat) -->
                                        @if ($booking->tombol_pengembalian_aktif)
                                            <a href="{{ route('admin.bookings.pengembalian', $booking->id) }}"
                                                class="text-green-600 hover:text-green-900 bg-green-50 px-3 py-1 rounded border border-green-200"
                                                title="Proses Pengembalian dengan Denda">
                                                <i class="fas fa-car-side mr-1"></i> Proses Pengembalian
                                            </a>
                                        @endif

                                        <!-- Tombol cancel -->
                                        <button type="button" onclick="showCancelModal({{ $booking->id }})"
                                            class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-ban mr-1"></i> Cancel
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data booking
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($bookings->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-bold mb-4">Tolak Booking</h3>
            <form id="rejectForm" method="POST">
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

    <!-- Cancel Modal -->
    <div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-bold mb-4">Batalkan Booking</h3>
            <form id="cancelForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="alasan_cancel" class="block text-sm font-medium text-gray-700">Alasan
                        Pembatalan</label>
                    <textarea id="alasan_cancel" name="alasan" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Berikan alasan pembatalan..."
                        required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideCancelModal()"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Batalkan Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Simple -->
    <script>
        // Reject Modal Functions
        function showRejectModal(bookingId) {
            const form = document.getElementById('rejectForm');
            form.action = `/admin/bookings/${bookingId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('alasan').value = '';
        }

        // Cancel Modal Functions
        function showCancelModal(bookingId) {
            const form = document.getElementById('cancelForm');
            form.action = `/admin/bookings/${bookingId}/cancel`;
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        function hideCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
            document.getElementById('alasan_cancel').value = '';
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideRejectModal();
            }
        });

        document.getElementById('cancelModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideCancelModal();
            }
        });
    </script>
</body>

</html>
