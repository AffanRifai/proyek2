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

                {{-- Informasi mobil & penyewa --}}
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

                {{-- DETAIL PEMBAYARAN --}}
                <h5 class="fw-bold">Detail Pembayaran</h5>

                {{-- Countdown untuk DP/full jika perlu --}}
                @if ($booking->totalDibayar() == 0 && $booking->status !== 'expired' && !is_null($booking->expired_at))
                    <div class="alert alert-warning" id="countdown-wrapper">
                        <strong>Selesaikan Pembayaran Sebelum:</strong>
                        <span id="countdown" class="fw-bold text-danger"></span>
                    </div>
                @endif

                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                <p><strong>Total yang sudah Dibayar:</strong> Rp {{ number_format($booking->totalDibayar(), 0, ',', '.') }}
                </p>
                <p><strong>Sisa yang belum Dibayar:</strong> Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}</p>

                {{-- Tombol Aksi Pembayaran --}}
                <div class="mb-3" id="aksi-pembayaran-wrapper">
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
                                @elseif($booking->sisaBayar() > 0)
                                    {{-- Tampilkan tombol pelunasan online dan offline --}}
                                    <button id="pay-pelunasan" class="btn btn-success btn-sm">Bayar Sisa (Online)</button>

                                    {{-- Tombol offline hanya jika booking->canPelunasanOffline() --}}
                                    @if (method_exists($booking, 'canPelunasanOffline') && $booking->canPelunasanOffline())
                                        <button id="pay-pelunasan-offline" class="btn btn-outline-secondary btn-sm">Bayar
                                            Sisa (Offline)</button>
                                        <small class="d-block text-muted mt-2">Jika memilih offline, pembayaran harus
                                            dikonfirmasi admin saat penyerahan mobil.</small>
                                    @else
                                        <div class="alert alert-danger mt-2">
                                            Batas waktu pelunasan offline telah lewat. Hubungi admin jika ada kendala.
                                        </div>
                                    @endif
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

                {{-- Riwayat Pembayaran --}}
                <h6 class="fw-bold mt-3">Riwayat Pembayaran</h6>
                <ul class="list-group">
                    @forelse($booking->pembayaran as $p)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong>{{ ucfirst($p->jenis_pembayaran) }}</strong> —
                                {{ ucfirst($p->metode_pembayaran) }}<br>
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingId = {{ $booking->id }};
            const csrf = '{{ csrf_token() }}';

            function createSnap(jenis) {
                // disable tombol supaya user nggak spam
                togglePayButtons(true);

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
                        togglePayButtons(false);

                        if (res.snap_token) {
                            snap.pay(res.snap_token, {
                                onSuccess: () => location.reload(),
                                onPending: () => location.reload(),
                                onError: () => Swal.fire('Error', 'Transaksi gagal.', 'error')
                            });
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal mendapatkan snap token', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        togglePayButtons(false);
                        Swal.fire('Error', 'Request pembayaran gagal.', 'error');
                    });
            }

            function togglePayButtons(dis) {
                ['pay-dp', 'pay-pelunasan', 'pay-full', 'pay-pelunasan-offline'].forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.disabled = dis;
                });
            }

            // event listeners
            const btnDp = document.getElementById('pay-dp');
            if (btnDp) btnDp.addEventListener('click', () => createSnap('dp'));

            const btnPel = document.getElementById('pay-pelunasan');
            if (btnPel) btnPel.addEventListener('click', () => createSnap('pelunasan'));

            const btnFull = document.getElementById('pay-full');
            if (btnFull) btnFull.addEventListener('click', () => createSnap('bayar_penuh'));

            // ===== BAYAR OFFLINE (langsung daftar tanpa form) =====
            const btnPelOff = document.getElementById('pay-pelunasan-offline');
            if (btnPelOff) {
                btnPelOff.addEventListener('click', () => {
                    Swal.fire({
                        title: 'Ajukan Pembayaran Offline',
                        html: 'Kamu akan mendaftarkan permintaan pelunasan secara offline. Admin akan mengonfirmasi setelah pembayaran di tempat.<br><br>Lanjutkan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, daftar',
                        cancelButtonText: 'Batal'
                    }).then(result => {
                        if (!result.isConfirmed) return;

                        btnPelOff.disabled = true;

                        fetch("{{ route('pembayaran.offline') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    booking_id: bookingId,
                                    jenis: 'pelunasan_offline'
                                })
                            })
                            .then(r => r.json())
                            .then(res => {
                                btnPelOff.disabled = false;
                                if (res.success) {
                                    Swal.fire('Terdaftar', res.message ||
                                            'Permintaan bayar offline berhasil dikirim.',
                                            'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Gagal', res.message ||
                                        'Gagal mendaftar bayar offline.', 'error');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                btnPelOff.disabled = false;
                                Swal.fire('Error', 'Request gagal.', 'error');
                            });
                    });
                });
            }
        });
    </script>

    {{-- COUNTDOWN (untuk expired_at jika ada) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const expiredAt = "{{ $booking->expired_at }}";
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
