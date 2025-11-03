<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Payment Monitor - KAWA Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">🔍 Advanced Payment Monitor</h1>
            <p class="text-gray-600">Real-time monitoring sistem pembayaran otomatis</p>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-4 gap-4 mt-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $syncStats['total'] ?? 0 }}</div>
                    <div class="text-blue-700 font-semibold">Total Payments</div>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $syncStats['success'] ?? 0 }}</div>
                    <div class="text-green-700 font-semibold">Success</div>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $syncStats['pending'] ?? 0 }}</div>
                    <div class="text-yellow-700 font-semibold">Pending</div>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $syncStats['failed'] ?? 0 }}</div>
                    <div class="text-red-700 font-semibold">Failed</div>
                </div>
            </div>

            <!-- Sync Info -->
            <div class="mt-4 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-gray-700">🔄 Auto Sync Status</h3>
                        <p class="text-sm text-gray-600">Last sync: {{ $lastSync ?? 'Never' }}</p>
                    </div>
                    <div class="space-x-2">
                        <a href="/sync-all-payments" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                            🔄 Sync Now
                        </a>
                        <a href="/payment-monitor" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                            📊 Basic Monitor
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-xl font-bold text-gray-800">Recent Payments (Last 25)</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentPayments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $payment->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $payment->booking->id_transaksi ?? 'N/A' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $payment->booking->nama_penyewa ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $payment->booking->car->merk ?? 'N/A' }} {{ $payment->booking->car->model ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $payment->booking->car->no_polisi ?? '' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $payment->jenis_pembayaran == 'dp' ? 'bg-blue-100 text-blue-800' : 
                                       ($payment->jenis_pembayaran == 'pelunasan' ? 'bg-green-100 text-green-800' : 
                                       ($payment->jenis_pembayaran == 'denda' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $payment->jenis_pembayaran)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($payment->jumlah, 0, ',', '.') }}
                                @if($payment->jumlah_dibayar > 0)
                                    <div class="text-xs text-green-600">
                                        Paid: Rp {{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $payment->status_pembayaran == 'sukses' ? 'bg-green-100 text-green-800' : 
                                       ($payment->status_pembayaran == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($payment->status_pembayaran) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $payment->created_at->format('d/m H:i') }}
                                @if($payment->dibayar_pada)
                                    <div class="text-xs text-green-600">
                                        Paid: {{ $payment->dibayar_pada->format('d/m H:i') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                @if($payment->status_pembayaran == 'menunggu')
                                    <a href="/sync-payment/{{ $payment->id }}" 
                                       class="text-blue-600 hover:text-blue-900" title="Sync Status">
                                        🔄
                                    </a>
                                @endif
                                <a href="/check-transaction-status/{{ $payment->midtrans_order_id }}" 
                                   class="text-green-600 hover:text-green-900" title="Check Midtrans">
                                    📡
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                No payments found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">🚀 Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="/auto-test-payment/dp" 
                   class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition duration-200">
                    <div class="text-2xl mb-2">🔵</div>
                    <div class="font-semibold">Test DP Payment</div>
                </a>
                <a href="/auto-test-payment/bayar_penuh" 
                   class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition duration-200">
                    <div class="text-2xl mb-2">🟢</div>
                    <div class="font-semibold">Test Full Payment</div>
                </a>
                <a href="/test-callback-setup" 
                   class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition duration-200">
                    <div class="text-2xl mb-2">⚙️</div>
                    <div class="font-semibold">Check Callback</div>
                </a>
                <a href="/callback-monitor" 
                   class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-lg text-center transition duration-200">
                    <div class="text-2xl mb-2">📡</div>
                    <div class="font-semibold">Callback Monitor</div>
                </a>
            </div>
        </div>

        <!-- System Info -->
        <div class="mt-6 bg-gray-800 text-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">ℹ️ System Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <strong>Current Ngrok URL:</strong><br>
                    <code class="bg-gray-700 p-1 rounded">{{ config('app.url') }}</code>
                </div>
                <div>
                    <strong>Midtrans Callback URL:</strong><br>
                    <code class="bg-gray-700 p-1 rounded">{{ config('midtrans.callback_url') }}</code>
                </div>
                <div>
                    <strong>Server Time:</strong><br>
                    {{ now()->toDateTimeString() }}
                </div>
                <div>
                    <strong>Auto Sync:</strong><br>
                    Every 3 minutes (via Laravel Scheduler)
                </div>
            </div>
        </div>
    </div>

    <!-- Auto-refresh every 30 seconds -->
    <script>
        setTimeout(() => {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>