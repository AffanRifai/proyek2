<!DOCTYPE html>
<html>

<head>
    <title>Payment Monitor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">🔍 Payment System Monitor</h1>

        <!-- Statistics -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</div>
                <div class="text-gray-600">Total Payments</div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div class="text-2xl font-bold text-green-600">{{ $stats['success'] }}</div>
                <div class="text-gray-600">Success</div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                <div class="text-gray-600">Pending</div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div class="text-2xl font-bold text-red-600">{{ $stats['failed'] }}</div>
                <div class="text-gray-600">Failed</div>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Booking ID</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentPayments as $payment)
                        <tr class="border-t">
                            <td class="px-6 py-4">{{ $payment->id }}</td>
                            <td class="px-6 py-4">{{ $payment->booking->id_transaksi }}</td>
                            <td class="px-6 py-4">{{ $payment->jenis_pembayaran }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-xs rounded 
                                {{ $payment->status_pembayaran == 'sukses'
                                    ? 'bg-green-100 text-green-800'
                                    : ($payment->status_pembayaran == 'menunggu'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-red-100 text-red-800') }}">
                                    {{ $payment->status_pembayaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $payment->created_at->format('d/m H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold mb-4">Quick Test Actions</h2>
            <div class="space-y-2">
                <a href="/test-payment-flow/1/dp" class="text-blue-600 hover:underline block">
                    🔵 Test DP Payment (Booking ID: 1)
                </a>
                <a href="/test-payment-flow/1/bayar_penuh" class="text-blue-600 hover:underline block">
                    🟢 Test Full Payment (Booking ID: 1)
                </a>
                <a href="/payment-monitor" class="text-blue-600 hover:underline block">
                    🔄 Refresh Monitor
                </a>
            </div>
        </div>
    </div>

    <!-- Auto-refresh every 10 seconds -->
    <script>
        setTimeout(() => {
            window.location.reload();
        }, 10000);
    </script>
</body>

</html>
