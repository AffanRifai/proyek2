<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\PembayaranController;
use App\Models\Pembayaran;
use Illuminate\Support\Collection;

class PreparePelunasanRecordTest extends TestCase
{
    public function test_prepare_pelunasan_updates_existing_dp()
    {
        // setup: buat controller instance
        $controller = new PembayaranController();

        // buat objek pembayaran DP palsu menggunakan kelas mock dengan method update
        $dp = new class {
            public $id = 123;
            public $jenis_pembayaran = 'dp';
            public $jumlah = 30000;
            public $original_dp_amount = null;
            public $status_pembayaran = 'menunggu';
            public $midtrans_order_id = null;
            public $tanggal_jatuh_tempo = null;

            public function update($data)
            {
                foreach ($data as $k => $v) {
                    $this->$k = $v;
                }
                return true;
            }
        };

        // buat booking-like object dengan relasi pembayaran yang berisi dp
        $booking = new \stdClass();
        $booking->id = 1;
        $booking->pembayaran = collect([$dp]);

        $pembayaran = $controller->preparePelunasanRecord($booking, 70000, 'ORDER-123');

        $this->assertEquals('pelunasan', $pembayaran->jenis_pembayaran);
        $this->assertEquals(70000, $pembayaran->jumlah);
    }
}
