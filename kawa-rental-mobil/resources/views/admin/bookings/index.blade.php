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
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Booking</h1>
            <a href="{{ route('admin.bookings.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
            </a>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
                <div class="text-gray-600">Total Booking</div>
            </div>
            <div class="bg-yellow-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-yellow-800">{{ $stats['pending'] }}</div>
                <div class="text-yellow-600">Pending</div>
            </div>
            <div class="bg-green-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-green-800">{{ $stats['approved'] }}</div>
                <div class="text-green-600">Approved</div>
            </div>
            <div class="bg-red-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-red-800">{{ $stats['rejected'] }}</div>
                <div class="text-red-600">Rejected</div>
            </div>
            <div class="bg-blue-100 rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-blue-800">{{ $stats['completed'] }}</div>
                <div class="text-blue-600">Completed</div>
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
                            <div class="text-sm text-gray-500">{{ $booking->created_at->format('d/m/Y H:i') }}</div>
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
                                {{ $booking->mulai_tgl->format('d/m/Y') }} - {{ $booking->sel_tgl->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-500">{{ $booking->lama_hari }} hari</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-500">{{ ucfirst($booking->tipe_pembayaran) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status_badge }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                
                                @if($booking->status == 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="inline">
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
                                
                                @if($booking->status == 'approved')
                                <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-900"
                                            onclick="return confirm('Tandai booking sebagai selesai?')">
                                        <i class="fas fa-flag-checkered"></i> Complete
                                    </button>
                                </form>
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
            @if($bookings->hasPages())
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
                    <textarea id="alasan" name="alasan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2" 
                              placeholder="Berikan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideRejectModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
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
        function showRejectModal(bookingId) {
            const form = document.getElementById('rejectForm');
            form.action = `/admin/bookings/${bookingId}/reject`;
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