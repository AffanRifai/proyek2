<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use App\Models\Pembayaran;

use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransaksiController extends Controller
{
    public function nota($id)
    {
        $pembayaran = Pembayaran::with('booking')->findOrFail($id);
        $verificationUrl = route('transaksi.downloadNota', $pembayaran->id);

        // QR code langsung generate
        $qrcode = QrCode::format('svg')->size(150)->generate($verificationUrl);

        $logoPath = public_path('images/logo.png');

        return view('transaksi.nota', compact('pembayaran', 'qrcode', 'logoPath'));
    }

    public function downloadNota($id)
    {
        $pembayaran = Pembayaran::with('booking')->findOrFail($id);
        $verificationUrl = route('transaksi.downloadNota', $pembayaran->id);
        $qrcode = QrCode::format('svg')->size(150)->generate($verificationUrl);
        $logoPath = public_path('images/logo.png');

        $pdf = Pdf::loadView('transaksi.nota-pdf', compact('pembayaran', 'qrcode', 'logoPath'));
        $filename = 'Nota_Transaksi_' . $pembayaran->booking->id_transaksi . '.pdf';

        return $pdf->download($filename);
    }

    public function downloadNotaGambar($id)
    {
        // Ambil data pembayaran + booking
        $pembayaran = Pembayaran::with('booking')->findOrFail($id);

        // Generate QR Code SVG
        $verificationUrl = route('transaksi.show', $pembayaran->id);
        $qrcode = QrCode::format('svg')->size(150)->generate($verificationUrl);

        // Render HTML dari Blade
        $html = View::make('transaksi.nota', compact('pembayaran', 'qrcode'))->render();

        // Tentukan path penyimpanan sementara
        $filePath = storage_path('app/public/nota_' . $id . '.png');

        // Ubah HTML menjadi PNG menggunakan Browsershot
        Browsershot::html($html)
            ->windowSize(1080, 1440)
            ->waitUntilNetworkIdle()
            ->setScreenshotType('png')
            ->save($filePath);

        // Kembalikan file sebagai download response
        return response()->download($filePath, 'nota_transaksi_' . $id . '.png')->deleteFileAfterSend(true);
    }


    public function showNota($id)
    {
        $pembayaran = \App\Models\Pembayaran::with('booking.car')->findOrFail($id);

        // QR Code dalam bentuk base64 PNG agar tampil juga di PDF
        $qrcode = base64_encode(
            QrCode::format('png')
                ->size(200)
                ->errorCorrection('H')
                ->generate($data)
        );

        return view('transaksi.nota-pdf', compact('transaksi', 'qrcode'));
    }


    public function downloadNotaPDF($id)
    {
        $transaksi = Pembayaran::with(['booking.car', 'booking.user'])->findOrFail($id);

        // isi QR code dengan informasi penting
        $data = 'Kode Booking: ' . $transaksi->booking->kode_booking . "\n" .
            'Nama: ' . $transaksi->booking->user->name . "\n" .
            'Mobil: ' . $transaksi->booking->car->nama_mobil . "\n" .
            'Total: Rp' . number_format($transaksi->jumlah_bayar, 0, ',', '.');

        // generate QR base64 (tanpa imagick)
        $qrcode = base64_encode(
            \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(200)
                ->errorCorrection('H')
                ->generate($data)
        );

        // kirim ke view pdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.nota-pdf', [
            'pembayaran' => $transaksi,
            'transaksi' => $transaksi,
            'qrcode' => $qrcode
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Nota_' . $transaksi->booking->id_transaksi . '.pdf');
    }
}
