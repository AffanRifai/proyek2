@extends('layout.app')

@section('title', 'Pesanan Saya - KAWA Rental Mobil')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center fw-bold">Pesanan Saya</h2>

        <div class="row mb-3">
            <div class="col-md-8">
                <form method="GET" action="{{ route('pesanan.index') }}" class="row g-2">
                    <div class="col-auto">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                ({{ $counts['pending'] ?? 0 }})</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                                ({{ $counts['approved'] ?? 0 }})</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                ({{ $counts['cancelled'] ?? 0 }})</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select name="payment" class="form-select">
                            <option value="">Semua Pembayaran</option>
                            <option value="menunggu" {{ request('payment') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                ({{ $counts['menunggu'] ?? 0 }})</option>
                            <option value="dp_dibayar" {{ request('payment') == 'dp_dibayar' ? 'selected' : '' }}>DP Dibayar
                            </option>
                            <option value="lunas" {{ request('payment') == 'lunas' ? 'selected' : '' }}>Lunas
                                ({{ $counts['lunas'] ?? 0 }})</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-muted">Total pesanan: {{ $counts['all'] ?? $bookings->total() }}</small>
            </div>
        </div>

        @if ($bookings->isEmpty())
            <div class="alert alert-info text-center shadow-sm">Belum ada pesanan yang kamu buat.</div>
        @else
            <div class="table-responsive shadow rounded-3">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Mobil</th>
                            <th>Tanggal Sewa</th>
                            <th>Lama</th>
                            <th>Total</th>
                            <th>Status Sewa</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $b)
                            <tr>
                                <td>{{ $b->id_transaksi }}</td>
                                <td>{{ $b->car->merk }} {{ $b->car->model }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->mulai_tgl)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($b->sel_tgl)->format('d M Y') }}</td>
                                <td>{{ $b->lama_hari }} hari</td>
                                <td>Rp {{ number_format($b->total_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $b->status == 'approved' ? 'success' : ($b->status == 'pending' ? 'warning' : ($b->status == 'cancelled' ? 'danger' : 'secondary')) }}">
                                        {{ ucfirst($b->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $b->status_pembayaran == 'lunas' ? 'success' : ($b->status_pembayaran == 'menunggu' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($b->status_pembayaran) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pesanan.show', $b->id) }}" class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>

                                    @if ($b->isCancelable())
                                        <button class="btn btn-danger btn-sm btn-cancel"
                                            data-id="{{ $b->id }}">Batalkan</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-3">
                    {{ $bookings->links() }} <!-- pagination links (Bootstrap default) -->
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-cancel');
            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;
                    const id = this.dataset.id;
                    fetch(`{{ url('/pesanan-saya') }}/${id}/cancel`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.message === 'Pesanan dibatalkan' || data.message) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert('Gagal membatalkan pesanan');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Terjadi error. Cek console.');
                        });
                });
            });
        });
    </script>
@endsection
