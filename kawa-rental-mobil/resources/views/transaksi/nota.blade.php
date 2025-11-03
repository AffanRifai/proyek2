<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi #{{ $pembayaran->booking->id_transaksi }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .nota-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: auto;
            padding: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            color: #1f2937;
        }

        .company {
            text-align: right;
        }

        .company h2 {
            font-size: 18px;
            margin: 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #374151;
        }

        .info-box {
            background: #f3f4f6;
            padding: 10px 15px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f9fafb;
            text-align: left;
            font-weight: 600;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6b7280;
        }

        .qrcode {
            text-align: right;
            margin-top: 10px;
        }

        .status {
            padding: 4px 10px;
            border-radius: 6px;
            color: #fff;
            font-size: 12px;
            text-transform: uppercase;
        }

        .status.menunggu {
            background: #f59e0b;
        }

        .status.sukses {
            background: #10b981;
        }

        .status.gagal {
            background: #ef4444;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <div class="header">
            <div>
                <h1>Nota Transaksi</h1>
                <small>ID Transaksi: <strong>{{ $pembayaran->booking->id_transaksi }}</strong></small><br>
                <small>Tanggal: {{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('d M Y H:i') }}</small>
            </div>
            <div class="company">
                <h2>Kawa Rental Mobil</h2>
                <small>Tangerang, Indonesia</small><br>
                <small>Telp: 0812-XXXX-XXXX</small>
            </div>
        </div>

        <div class="info-grid">
            <div>
                <div class="section-title">Data Penyewa</div>
                <div class="info-box">
                    <strong>{{ $pembayaran->booking->nama_penyewa }}</strong><br>
                    {{ $pembayaran->booking->no_telp }}<br>
                    {{ $pembayaran->booking->alamat }}
                </div>
            </div>
            <div>
                <div class="section-title">Informasi Mobil</div>
                <div class="info-box">
                    {{ $pembayaran->booking->car->merk }} {{ $pembayaran->booking->car->model }}<br>
                    No. Polisi: {{ $pembayaran->booking->car->no_polisi }}<br>
                    Biaya Harian: Rp{{ number_format($pembayaran->booking->car->biaya_harian, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Lama</th>
                    <th>Biaya/Hari</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sewa Mobil ({{ $pembayaran->booking->tujuan }})</td>
                    <td>{{ $pembayaran->booking->lama_hari }} hari</td>
                    <td>Rp{{ number_format($pembayaran->booking->biaya_harian, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($pembayaran->booking->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <p class="total">Total Dibayar: Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
        <p>Status Pembayaran:
            <span class="status {{ strtolower($pembayaran->status_pembayaran) }}">
                {{ ucfirst($pembayaran->status_pembayaran) }}
            </span>
        </p>

        <div class="qrcode">
            <div>{!! $qrcode !!}</div>
            <small>Scan untuk verifikasi transaksi</small>
        </div>

        <a href="{{ route('transaksi.nota.pdf', $pembayaran->id) }}"
            style="background:#3b82f6;color:#fff;padding:8px 14px;border-radius:6px;text-decoration:none;">
            📄 Unduh Nota (PDF)
        </a>


        <div class="footer">
            <p>Terima kasih telah menggunakan layanan Kawa Rental Mobil.</p>
            <small>Nota ini dibuat secara otomatis oleh sistem.</small>
        </div>
    </div>
</body>

</html>
