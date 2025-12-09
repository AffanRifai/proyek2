<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;
use App\Models\Pembayaran;
use App\Models\User;

class PelunasanUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_pelunasan_online_updates_existing_dp_record()
    {
        // buat user, booking, dan pembayaran DP
        $user = User::factory()->create();

        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'total_pembayaran' => 100000,
            'jumlah_dp' => 30000,
            'sisa_pembayaran' => 70000,
            'status_pembayaran' => 'menunggu',
        ]);

        $dp = Pembayaran::create([
            'booking_id' => $booking->id,
            'jenis_pembayaran' => 'dp',
            'metode_pembayaran' => 'midtrans',
            'saluran_pembayaran' => 'online',
            'jumlah' => 30000,
            'jumlah_dibayar' => 0,
            'status_pembayaran' => 'menunggu',
            'midtrans_order_id' => 'DP-TEST',
        ]);

        // simulasikan request createSnap untuk pelunasan
        $response = $this->postJson(route('pembayaran.create_snap'), [
            'booking_id' => $booking->id,
            'jenis_pembayaran' => 'pelunasan',
        ]);

        $response->assertStatus(200);
        $data = $response->json();
        $this->assertArrayHasKey('pembayaran_id', $data);

        // pastikan id pembayaran yang dikembalikan sama dengan dp (diupdate)
        $this->assertEquals($dp->id, $data['pembayaran_id']);

        // reload from db
        $dp->refresh();
        $this->assertEquals('pelunasan', $dp->jenis_pembayaran);
        $this->assertEquals(70000, (int)$dp->jumlah);
    }
}
