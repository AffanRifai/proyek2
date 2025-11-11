@extends('layout.app')

@section('title', 'Detail Pesanan - KAWA Rental Mobil')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Pesanan - {{ $booking->id_transaksi }}</h4>
                <div>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    <a href="{{ url('/nota/' . $booking->id) }}" class="btn btn-success btn-sm" target="_blank">Cetak Nota</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-2">Informasi Mobil</h5>
                        <p><strong>Mobil:</strong> {{ $booking->car->merk }} {{ $booking->car->model }}</p>
                        <p><strong>Nomor Polisi:</strong> {{ $booking->car->no_polisi }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-2">Informasi Penyewa</h5>
                        <p><strong>Nama:</strong> {{ $booking->nama_penyewa }}</p>
                        <p><strong>No Telp:</strong> {{ $booking->no_telp }}</p>
                    </div>
                </div>

                <hr>
                <h5 class="fw-bold">Detail Pembayaran</h5>
                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                <p><strong>Total yang sudah Dibayar:</strong> Rp {{ number_format($booking->totalDibayar(), 0, ',', '.') }}</p>
                <p><strong>Sisa yang belum Dibayar:</strong> Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}</p>
                <div class="mb-3">
                    @if ($booking->status_pembayaran !== 'lunas')
                        @if ($booking->requiresDp())
                            {{-- Kasus: sistem menggunakan DP --}}
                            @if ($booking->totalDibayar() == 0)
                                {{-- Belum bayar sama sekali --}}
                                <button id="pay-dp" class="btn btn-primary btn-sm">Bayar DP</button>
                            @elseif($booking->sisaBayar() > 0)
                                {{-- Sudah bayar DP tapi belum lunas --}}
                                <button id="pay-pelunasan" class="btn btn-success btn-sm">Bayar Sisa</button>
                            @endif
                        @else
                            {{-- Kasus: tidak pakai DP, langsung bayar penuh --}}
                            @if ($booking->totalDibayar() == 0)
                                <button id="pay-full" class="btn btn-success btn-sm">Bayar Penuh</button>
                            @endif
                        @endif
                    @else
                        <span class="badge bg-success">LUNAS</span>
                    @endif
                </div>


                <h6 class="fw-bold mt-3">Riwayat Pembayaran</h6>
                <ul class="list-group">
                    @forelse($booking->pembayaran as $p)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong>{{ ucfirst($p->jenis_pembayaran) }}</strong> —
                                {{ ucfirst($p->metode_pembayaran) }}
                                <br>
                                <small class="text-muted">Status: {{ $p->status_pembayaran }}</small>
                            </div>
                            <div>
                                Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                                <br>
                                <small
                                    class="text-muted">{{ $p->dibayar_pada ? \Carbon\Carbon::parse($p->dibayar_pada)->format('d M Y H:i') : '' }}</small>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada pembayaran</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- include midtrans snap script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingId = {{ $booking->id }};
            const csrf = '{{ csrf_token() }}';

            function createSnap(jenis) {
                fetch("{{ route('pembayaran.create_snap') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            booking_id: bookingId,
                            jenis_pembayaran: jenis
                        })
                    })
                    .then(r => r.json())
                    .then(res => {
                        if (res.snap_token) {
                            snap.pay(res.snap_token, {
                                onSuccess: function(result) {
                                    alert('Pembayaran sukses, menunggu konfirmasi.');
                                    location.reload();
                                },
                                onPending: function(result) {
                                    alert('Pembayaran pending, silakan selesaikan pembayaran.');
                                    location.reload();
                                },
                                onError: function(result) {
                                    alert('Terjadi error pembayaran.');
                                    console.log(result);
                                },
                                onClose: function() {
                                    // user closed payment popup
                                }
                            });
                        } else {
                            alert(res.message || 'Gagal mendapatkan snap token');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error request pembayaran. Cek console.');
                    });
            }

            const btnDp = document.getElementById('pay-dp');
            if (btnDp) btnDp.addEventListener('click', function() {
                createSnap('dp');
            });

            const btnPel = document.getElementById('pay-pelunasan');
            if (btnPel) btnPel.addEventListener('click', function() {
                createSnap('pelunasan');
            });

            const btnFull = document.getElementById('pay-full');
            if (btnFull) btnFull.addEventListener('click', function() {
                createSnap('bayar_penuh');
            });
        });
    </script>
@endsection
