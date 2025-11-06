<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi #{{ $pembayaran->booking->id_transaksi }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 11px;
            line-height: 1.4;
            background: white;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .a4-container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
            padding: 10mm;
            background: white;
            box-sizing: border-box;
        }

        .pdf-header {
            text-align: center;
            padding-bottom: 8px;
            margin-bottom: 12px;
            border-bottom: 2px solid #dc2626;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #dc2626;
        }

        .company-tagline {
            font-size: 10px;
            color: #666;
            font-style: italic;
        }

        .receipt-title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 6px;
            text-transform: uppercase;
        }

        .status-badge {
            display: inline-block;
            background: #059669;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 9px;
            margin-top: 5px;
        }

        .transaction-info {
            font-size: 9px;
            color: #666;
            margin-top: 4px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin: 10px 0 6px 0;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
            text-transform: uppercase;
        }

        /* Struktur kolom aman untuk PDF */
        .two-column {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 10px;
        }

        .column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 4px;
        }

        .info-label,
        .info-colon,
        .info-value {
            display: table-cell;
            vertical-align: top;
            font-size: 10px;
        }

        .info-label {
            width: 85px;
            font-weight: 600;
            color: #4a5568;
        }

        .info-colon {
            width: 10px;
            text-align: center;
        }

        .info-value {
            color: #2d3748;
            word-wrap: break-word;
        }

        .highlight {
            color: #dc2626;
            font-weight: bold;
        }

        /* Tabel pembayaran */
        .billing-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            table-layout: fixed;
        }

        .billing-table th {
            background: #dc2626;
            color: white;
            padding: 6px;
            font-size: 9px;
            text-align: left;
            word-wrap: break-word;
        }

        .billing-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 6px;
            font-size: 10px;
            word-wrap: break-word;
        }

        .text-right {
            text-align: right;
        }

        /* Ringkasan */
        .summary-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px;
            margin-top: 8px;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 3px 0;
            font-size: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .summary-table tr:last-child td {
            border-bottom: none;
        }

        .total-row {
            font-weight: bold;
            font-size: 11px;
        }

        .total-amount {
            color: #059669;
            font-size: 12px;
        }

        /* Metode pembayaran */
        .payment-method {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 10px;
            margin-top: 8px;
        }

        .verification-container {
            position: relative;
            width: 100%;
            margin: 18 0px;
            padding: 10px 0;
            min-height: 150px;

        }

        .verification-left {
            width: 60%;
            padding-right: 20px;
        }

        .verification-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 140px;
            text-align: center;
        }

        .verification-right img {
            width: 120px;
            height: 120px;
            display: inline-block;
            border: 1px solid #e2e8f0;
            padding: 8px;
        }

        .verification-info {
            font-size: 10px;
            color: #666;
            line-height: 1.4;
        }


        .verification-title {
            font-weight: 700;
            margin-bottom: 6px;
            font-size: 11px;
            color: #2d3748;
        }

        .verification-subtitle {
            font-size: 9px;
            margin-top: 5px;
            margin-bottom: 5px;
            color: #666;
        }

        .pdf-footer {
            text-align: center;
            border-top: 1px solid #dc2626;
            padding-top: 8px;
            margin-top: 12px;
            font-size: 9px;
            color: #718096;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .a4-container {
                padding: 10mm;
                max-width: 180mm;
            }
        }
    </style>
</head>

<body>
    <div class="a4-container">
        <div class="pdf-header">
            <div class="company-name">KAWA RENTAL MOBIL</div>
            <div class="receipt-title">Nota Pembayaran</div>
            <div class="transaction-info">
                No. Referensi: <span class="highlight">{{ $pembayaran->booking->id_transaksi }}</span> |
                Tanggal: {{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('d/m/Y') }} |
                Status: <span style="color:#059669;">{{ ucfirst($pembayaran->status_pembayaran) }}</span>
            </div>
        </div>

        <div class="two-column">
            <div class="column">
                <div class="section-title">Informasi Pelanggan</div>
                <div class="info-row">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-colon">:</div>
                    <div class="info-value highlight">{{ $pembayaran->booking->nama_penyewa }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pembayaran->booking->no_telp }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pembayaran->booking->alamat ?? '-' }}</div>
                </div>
            </div>
            <div class="column">
                <div class="section-title">Informasi Kendaraan</div>
                <div class="info-row">
                    <div class="info-label">Kendaraan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value highlight">{{ $pembayaran->booking->car->merk }}
                        {{ $pembayaran->booking->car->model }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Polisi</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pembayaran->booking->car->no_polisi }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tujuan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $pembayaran->booking->tujuan }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Lama Sewa</div>
                    <div class="info-colon">:</div>
                    <div class="info-value highlight">{{ $pembayaran->booking->lama_hari }} Hari</div>
                </div>
            </div>
        </div>

        <div class="section-title">Periode Sewa</div>
        <div class="two-column">
            <div class="column">
                <div class="info-row">
                    <div class="info-label">Tanggal Mulai</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($pembayaran->booking->mulai_tgl)->format('d F Y') }}</div>
                </div>
            </div>
            <div class="column">
                <div class="info-row">
                    <div class="info-label">Tanggal Selesai</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($pembayaran->booking->sel_tgl)->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="section-title">Rincian Pembayaran</div>
        <table class="billing-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Biaya/Hari</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sewa Mobil {{ $pembayaran->booking->car->merk }} {{ $pembayaran->booking->car->model }}</td>
                    <td>{{ $pembayaran->booking->lama_hari }} Hari</td>
                    <td>Rp{{ number_format($pembayaran->booking->biaya_harian, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($pembayaran->booking->total_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="summary-section">
            <div class="section-title">Ringkasan Pembayaran</div>
            <table class="summary-table">
                <tr>
                    <td>Subtotal Sewa</td>
                    <td class="text-right">Rp{{ number_format($pembayaran->booking->total_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Biaya Administrasi</td>
                    <td class="text-right">Rp{{ number_format(6500, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Sisa Pembayaran</td>
                    <td class="text-right">Rp{{ number_format($pembayaran->booking->sisa_pembayaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="total-row">
                    <td>TOTAL DIBAYAR</td>
                    <td class="text-right total-amount">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="payment-method">
            <div class="section-title">Metode Pembayaran</div>
            <div class="info-row">
                <div class="info-label">Jenis</div>
                <div class="info-colon">:</div>
                <div class="info-value highlight">{{ strtoupper($pembayaran->jenis_pembayaran) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Metode</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ ucfirst($pembayaran->metode_pembayaran) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Saluran</div>
                <div class="info-colon">:</div>
                <div class="info-value">{{ ucfirst($pembayaran->saluran_pembayaran) }}</div>
            </div>
        </div>

        <div class="verification-container">
            <div class="verification-left">
                <div class="verification-info">
                    <div style="font-weight: bold; margin-bottom: 5px;">Keterangan:</div>
                    <div>• Nota ini sah dan dapat digunakan sebagai bukti pembayaran</div>
                    <div>• Simpan nota ini untuk keperluan verifikasi</div>
                    <div>• Untuk pertanyaan hubungi customer service</div>
                </div>
            </div>

            <div class="verification-right">
                <div class="verification-title">Verifikasi Pembayaran</div>
                @if (!empty($qrcode))
                    <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code" />
                @else
                    <div
                        style="width:120px; height:120px; border:1px solid #e2e8f0; display:flex; align-items:center; justify-content:center; font-size:9px; color:#666;">
                        QR Code<br>Tidak Tersedia
                    </div>
                @endif
                <div class="verification-subtitle">Scan QR untuk melihat detail transaksi dan validasi</div>
            </div>
        </div>
        <div class="pdf-footer">
            <div style="text-align:center; margin-top:8px; font-size:10px;">
                Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}
            </div>
            <div class="text-bold">Terima kasih atas kepercayaan Anda menggunakan layanan Kawa Rental Mobil</div>
            <div>Pasar Mambo, JL. Jendral Ahmad Yani, Lemahabang, Indramayu, Jawa Barat</div>
            <div>Telp: 0823-1583-6060 | Email: prasetyoluckyindra@gmail.com</div>
            <div>Nota ini diterbitkan secara elektronik dan tidak memerlukan cap basah</div>
        </div>
    </div>
</body>

</html>
