<!DOCTYPE html>
<html>

<head>
    <title>Callback Monitor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">📡 Callback Monitor</h1>

        <div class="bg-gray-800 p-4 rounded mb-4">
            <h2 class="text-lg font-semibold mb-2">Callback URL Info:</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <strong>Your Ngrok URL:</strong><br>
                    <code class="bg-gray-700 p-1 rounded">{{ config('midtrans.callback_url') }}</code>
                </div>
                <div>
                    <strong>Midtrans Config:</strong><br>
                    <code class="bg-gray-700 p-1 rounded">Settings → Configuration → Payment Notification URL</code>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded shadow">
            <div class="px-4 py-2 bg-gray-700 font-semibold">
                Recent Callback Logs (Last 10)
            </div>
            <div class="p-4">
                @if (count($logs) > 0)
                    @foreach (array_reverse($logs) as $log)
                        <div class="border-b border-gray-700 py-2 font-mono text-sm">
                            {!! nl2br(e($log)) !!}
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-400">No callback logs found yet...</div>
                @endif
            </div>
        </div>

        <!-- Quick Test -->
        <div class="mt-6 bg-gray-800 p-4 rounded">
            <h2 class="text-lg font-semibold mb-2">Quick Test:</h2>
            <a href="{{ config('midtrans.callback_url') }}"
                class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded inline-block">
                Test Callback URL
            </a>
        </div>
    </div>

    <!-- Auto-refresh -->
    <script>
        setTimeout(() => {
            window.location.reload();
        }, 5000);
    </script>
</body>

</html>
