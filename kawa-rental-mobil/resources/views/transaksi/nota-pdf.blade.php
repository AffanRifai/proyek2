<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
        }

        .divider {
            height: 1px;
            background: #000;
            margin: 10px 0 20px 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items th,
        .items td {
            border: 1px solid #999;
            padding: 6px 8px;
        }

        .items th {
            background: #f0f0f0;
        }

        .total {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
        }

        .qrcode {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('img/logo-kawa.png') }}" width="80" alt="Logo">
    <div class="header">
        <h2>KAWA RENTAL MOBIL</h2>
        <div>Jl. Contoh Raya No.123, Tangerang</div>
        <div>Telp: 0812-XXXX-XXXX</div>
    </div>
    <div class="divider"></div>

    <table class="info-table">
        <tr>
            <td><strong>ID Transaksi:</strong> {{ $pembayaran->booking->id_transaksi }}</td>
            <td><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('d M Y H:i') }}
            </td>
        </tr>
        <tr>
            <td><strong>Nama Penyewa:</strong> {{ $pembayaran->booking->nama_penyewa }}</td>
            <td><strong>Nomor Telepon:</strong> {{ $pembayaran->booking->no_telp }}</td>
        </tr>
        <tr>
            <td><strong>Alamat:</strong> {{ $pembayaran->booking->alamat }}</td>
            <td><strong>Tujuan:</strong> {{ $pembayaran->booking->tujuan }}</td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>Mobil</th>
                <th>No. Polisi</th>
                <th>Durasi</th>
                <th>Harga/Hari</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pembayaran->booking->car->merk }} {{ $pembayaran->booking->car->model }}</td>
                <td>{{ $pembayaran->booking->car->no_polisi }}</td>
                <td>{{ $pembayaran->booking->lama_hari }} Hari</td>
                <td>Rp{{ number_format($pembayaran->booking->biaya_harian, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($pembayaran->booking->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <p class="total">Total Dibayar: Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
    <p><strong>Status Pembayaran:</strong> {{ ucfirst($pembayaran->status_pembayaran) }}</p>

    <div class="qrcode">
        {!! $qrcode !!}
        <br>
        <small>Scan untuk verifikasi</small>
    </div>

    <div class="footer">
        <p>Terima kasih telah mempercayakan perjalanan Anda kepada Kawa Rental Mobil.</p>
        <p>Nota ini sah tanpa tanda tangan.</p>
    </div>
</body>

</html>
