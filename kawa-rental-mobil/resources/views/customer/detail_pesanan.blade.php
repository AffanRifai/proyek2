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

                {{-- ======================= --}}
                {{-- Informasi mobil & penyewa --}}
                {{-- ======================= --}}
                <div class="row mb-3">
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

                {{-- ======================= --}}
                {{-- DETAIL PEMBAYARAN --}}
                {{-- ======================= --}}
                <h5 class="fw-bold">Detail Pembayaran</h5>

                {{-- Countdown hanya jika: BELUM BAYAR & BELUM EXPIRED --}}
                @if ($booking->totalDibayar() == 0 && $booking->status !== 'expired' && !is_null($booking->expired_at))
                    <div class="alert alert-warning" id="countdown-wrapper">
                        <strong>Selesaikan Pembayaran Sebelum:</strong>
                        <span id="countdown" class="fw-bold text-danger"></span>
                    </div>
                @endif

                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                <p><strong>Total yang sudah Dibayar:</strong> Rp {{ number_format($booking->totalDibayar(), 0, ',', '.') }}</p>
                <p><strong>Sisa yang belum Dibayar:</strong> Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}</p>

                {{-- ======================= --}}
                {{-- Tombol Aksi Pembayaran --}}
                {{-- ======================= --}}
                <div class="mb-3">
                    @if ($booking->status === 'expired')
                        <div class="alert alert-danger">
                            Pembayaran gagal karena melewati batas waktu.
                        </div>
                    @else
                        @if ($booking->status_pembayaran !== 'lunas')
                            @if ($booking->requiresDp())

                                {{-- Belum bayar apa pun --}}
                                @if ($booking->totalDibayar() == 0)
                                    <button id="pay-dp" class="btn btn-primary btn-sm">Bayar DP</button>

                                {{-- Sudah DP → bisa pelunasan --}}
                                @elseif($booking->sisaBayar() > 0)
                                    <button id="pay-pelunasan" class="btn btn-success btn-sm">Bayar Sisa</button>
                                @endif

                            @else
                                {{-- Tidak pakai DP --}}
                                @if ($booking->totalDibayar() == 0)
                                    <button id="pay-full" class="btn btn-success btn-sm">Bayar Penuh</button>
                                @endif

                            @endif
                        @else
                            <span class="badge bg-success">LUNAS</span>
                        @endif
                    @endif

                </div>

                {{-- ======================= --}}
                {{-- Riwayat Pembayaran --}}
                {{-- ======================= --}}
                <h6 class="fw-bold mt-3">Riwayat Pembayaran</h6>
                <ul class="list-group">
                    @forelse($booking->pembayaran as $p)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong>{{ ucfirst($p->jenis_pembayaran) }}</strong> — {{ ucfirst($p->metode_pembayaran) }}<br>
                                <small class="text-muted">Status: {{ $p->status_pembayaran }}</small>
                            </div>
                            <div>
                                Rp {{ number_format($p->jumlah, 0, ',', '.') }}<br>
                                <small class="text-muted">
                                    {{ $p->dibayar_pada ? \Carbon\Carbon::parse($p->dibayar_pada)->format('d M Y H:i') : '' }}
                                </small>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada pembayaran</li>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    {{-- ========================= --}}
    {{-- FUNGSI CREATE SNAP TOKEN --}}
    {{-- ========================= --}}
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
                    .then(res => res.json())
                    .then(res => {

                        if (res.snap_token) {
                            snap.pay(res.snap_token, {
                                onSuccess: () => location.reload(),
                                onPending: () => location.reload(),
                                onError: () => alert("Error pembayaran.")
                            });
                        } else {
                            alert(res.message || 'Gagal mendapatkan snap token');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error request pembayaran.');
                    });
            }

            if (document.getElementById('pay-dp'))
                document.getElementById('pay-dp').onclick = () => createSnap('dp');

            if (document.getElementById('pay-pelunasan'))
                document.getElementById('pay-pelunasan').onclick = () => createSnap('pelunasan');

            if (document.getElementById('pay-full'))
                document.getElementById('pay-full').onclick = () => createSnap('bayar_penuh');
        });
    </script>

    {{-- ========================= --}}
    {{-- COUNTDOWN TIMER FIX --}}
    {{-- ========================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const expiredAt = "{{ $booking->expired_at }}";

            // Jika expired_at null atau user sudah bayar → countdown tidak jalan
            if (!expiredAt || {{ $booking->totalDibayar() }} > 0) return;

            const countdownEl = document.getElementById("countdown");
            if (!countdownEl) return;

            const endTime = new Date(expiredAt).getTime();

            const interval = setInterval(() => {

                const now = new Date().getTime();
                const diff = endTime - now;

                if (diff <= 0) {
                    clearInterval(interval);
                    location.reload();
                    return;
                }

                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                countdownEl.innerText = `${minutes} menit ${seconds} detik`;

            }, 1000);
        });
    </script>

@endsection
