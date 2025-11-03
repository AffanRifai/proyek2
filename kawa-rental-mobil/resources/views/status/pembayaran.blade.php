<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran - Sistem Rental Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">📊 Status Pembayaran</h1>
                <p class="text-gray-600">Informasi lengkap status pembayaran dan booking</p>
            </div>

            <!-- Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Status Pembayaran -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-blue-600">
                        <i class="fas fa-credit-card mr-2"></i>Status Pembayaran
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium">ID Pembayaran:</span>
                            <span class="font-semibold">#{{ $data['pembayaran_id'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Jenis:</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('_', ' ', $data['jenis_pembayaran'])) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Status:</span>
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $data['status_pembayaran_table'] == 'sukses' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($data['status_pembayaran_table']) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Jumlah:</span>
                            <span class="font-semibold text-green-600">
                                Rp {{ number_format($data['jumlah'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Dibayar:</span>
                            <span class="font-semibold text-green-600">
                                Rp {{ number_format($data['jumlah_dibayar'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Booking -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-green-600">
                        <i class="fas fa-car mr-2"></i>Status Booking
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium">ID Transaksi:</span>
                            <span class="font-semibold">{{ $data['id_transaksi'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Booking ID:</span>
                            <span class="font-semibold">#{{ $data['booking_id'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Status Pembayaran:</span>
                            <span
                                class="px-2 py-1 text-xs rounded-full 
                                {{ $data['status_pembayaran_booking'] == 'lunas'
                                    ? 'bg-green-100 text-green-800'
                                    : ($data['status_pembayaran_booking'] == 'dp_dibayar'
                                        ? 'bg-blue-100 text-blue-800'
                                        : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $data['status_pembayaran_booking'] == 'dp_dibayar' ? 'DP Dibayar' : ucfirst($data['status_pembayaran_booking']) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Total Pembayaran:</span>
                            <span class="font-semibold">
                                Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Total Dibayar:</span>
                            <span class="font-semibold text-green-600">
                                Rp {{ number_format($data['total_dibayar'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Sisa Pembayaran:</span>
                            <span
                                class="font-semibold {{ $data['sisa_pembayaran'] > 0 ? 'text-red-600' : 'text-green-600' }}">
                                Rp {{ number_format($data['sisa_pembayaran'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Customer & Mobil -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-purple-600">
                        <i class="fas fa-user mr-2"></i>Informasi Customer & Mobil
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium">Customer:</span>
                            <span class="font-semibold">{{ $data['customer'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Mobil:</span>
                            <span class="font-semibold">{{ $data['mobil'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4 text-orange-600">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h2>
                    <div class="space-y-3">
                        <a href="{{ route('booking.show', $data['booking_id']) }}"
                            class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail Booking
                        </a>
                        <a href="{{ route('bookings.saya') }}"
                            class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Booking
                        </a>
                        <button onclick="refreshStatus()"
                            class="w-full bg-gray-500 text-white py-2 rounded hover:bg-gray-600 flex items-center justify-center">
                            <i class="fas fa-sync-alt mr-2"></i>Refresh Status
                        </button>
                    </div>
                </div>
            </div>

            <!-- JSON Data (for debugging) -->
            <details class="mt-8 bg-gray-100 rounded-lg p-4">
                <summary class="cursor-pointer font-semibold text-gray-700">
                    <i class="fas fa-code mr-2"></i>Raw Data (JSON)
                </summary>
                <pre class="mt-2 p-4 bg-gray-800 text-green-400 rounded overflow-auto text-sm">{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
            </details>
        </div>
    </div>

    <script>
        function refreshStatus() {
            fetch('/api/status-pembayaran/{{ $data['pembayaran_id'] }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal merefresh status');
                });
        }

        // Auto-refresh every 30 seconds
        setInterval(refreshStatus, 30000);
    </script>
</body>

</html>
