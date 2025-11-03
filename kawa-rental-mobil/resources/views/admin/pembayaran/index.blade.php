<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pembayaran - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Pembayaran</h1>
                <p class="text-gray-600">Kelola semua transaksi pembayaran</p>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-blue-600">{{ $statistik['total'] }}</div>
                <div class="text-gray-600">Total Pembayaran</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-green-600">Rp
                    {{ number_format($statistik['total_jumlah'], 0, ',', '.') }}</div>
                <div class="text-gray-600">Total Pemasukan</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-yellow-600">{{ $statistik['menunggu_verifikasi'] }}</div>
                <div class="text-gray-600">Menunggu Verifikasi</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-2xl font-bold text-red-600">{{ $statistik['gagal'] }}</div>
                <div class="text-gray-600">Pembayaran Gagal</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-wrap gap-4">
                <!-- Filter Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select onchange="window.location.href = this.value" class="border border-gray-300 rounded p-2">
                        <option value="{{ route('admin.pembayaran.index', ['status' => 'semua', 'jenis' => $jenis]) }}"
                            {{ $status == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => 'menunggu', 'jenis' => $jenis]) }}"
                            {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => 'menunggu_verifikasi', 'jenis' => $jenis]) }}"
                            {{ $status == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => 'sukses', 'jenis' => $jenis]) }}"
                            {{ $status == 'sukses' ? 'selected' : '' }}>Sukses</option>
                        <option value="{{ route('admin.pembayaran.index', ['status' => 'gagal', 'jenis' => $jenis]) }}"
                            {{ $status == 'gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>

                <!-- Filter Jenis -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                    <select onchange="window.location.href = this.value" class="border border-gray-300 rounded p-2">
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => $status, 'jenis' => 'semua']) }}"
                            {{ $jenis == 'semua' ? 'selected' : '' }}>Semua Jenis</option>
                        <option value="{{ route('admin.pembayaran.index', ['status' => $status, 'jenis' => 'dp']) }}"
                            {{ $jenis == 'dp' ? 'selected' : '' }}>DP</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => $status, 'jenis' => 'pelunasan']) }}"
                            {{ $jenis == 'pelunasan' ? 'selected' : '' }}>Pelunasan</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => $status, 'jenis' => 'bayar_penuh']) }}"
                            {{ $jenis == 'bayar_penuh' ? 'selected' : '' }}>Bayar Penuh</option>
                        <option
                            value="{{ route('admin.pembayaran.index', ['status' => $status, 'jenis' => 'denda']) }}"
                            {{ $jenis == 'denda' ? 'selected' : '' }}>Denda</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabel Pembayaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pembayaran as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->booking->id_transaksi }}</div>
                                <div class="text-sm text-gray-500">#{{ $item->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->booking->nama_penyewa }}</div>
                                <div class="text-sm text-gray-500">{{ $item->booking->no_telp }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                {{ $item->jenis_pembayaran == 'dp'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($item->jenis_pembayaran == 'pelunasan'
                                        ? 'bg-green-100 text-green-800'
                                        : ($item->jenis_pembayaran == 'denda'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->jenis_pembayaran)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Rp
                                    {{ number_format($item->jumlah, 0, ',', '.') }}</div>
                                @if ($item->jumlah_dibayar > 0)
                                    <div class="text-sm text-green-600">Dibayar: Rp
                                        {{ number_format($item->jumlah_dibayar, 0, ',', '.') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ ucfirst($item->metode_pembayaran) }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $item->saluran_pembayaran == 'online' ? 'Online' : 'Offline' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $item->badge_status_pembayaran }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_pembayaran)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->created_at->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $item->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.pembayaran.detail', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if ($item->status_pembayaran == 'menunggu_verifikasi' && $item->saluran_pembayaran == 'offline')
                                    <button onclick="verifikasiPembayaran({{ $item->id }})"
                                        class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data pembayaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($pembayaran->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $pembayaran->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div id="modalVerifikasi" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-bold mb-4">Verifikasi Pembayaran</h3>
            <form id="formVerifikasi" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Optional)</label>
                    <textarea name="catatan_admin" rows="3" class="w-full border border-gray-300 rounded-md p-2"
                        placeholder="Tambahkan catatan verifikasi..."></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="tutupModal()"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Verifikasi Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function verifikasiPembayaran(pembayaranId) {
            const form = document.getElementById('formVerifikasi');
            form.action = `/admin/pembayaran/${pembayaranId}/verifikasi`;
            document.getElementById('modalVerifikasi').classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modalVerifikasi').classList.add('hidden');
        }

        // Tutup modal ketika klik di luar
        document.getElementById('modalVerifikasi').addEventListener('click', function(e) {
            if (e.target === this) {
                tutupModal();
            }
        });
    </script>
</body>

</html>
