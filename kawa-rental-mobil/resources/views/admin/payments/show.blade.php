@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Detail Pembayaran #{{ $payment->id }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Manajemen
                                    Pembayaran</a></li>
                            <li class="breadcrumb-item active">Detail #{{ $payment->id }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="icon fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="icon fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Payment Status Overview -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    Status Pembayaran
                                </h3>
                                <div class="card-tools">
                                    <span
                                        class="badge badge-lg
                                        @if ($payment->status_pembayaran == 'sukses') badge-success
                                        @elseif($payment->status_pembayaran == 'menunggu') badge-warning
                                        @else badge-danger @endif">
                                        {{ ucfirst($payment->status_pembayaran) }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <div class="border rounded p-3 bg-light">
                                            <small class="text-muted d-block">Total Pembayaran</small>
                                            <h4 class="text-primary mb-0">Rp
                                                {{ number_format($payment->booking->total_pembayaran, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="border rounded p-3 bg-light">
                                            <small class="text-muted d-block">Jumlah Dibayar</small>
                                            <h4 class="text-success mb-0">Rp
                                                {{ number_format($payment->booking->total_dibayar, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="border rounded p-3 bg-light">
                                            <small class="text-muted d-block">Progress</small>
                                            <h4 class="mb-0">
                                                {{ $payment->jumlah > 0 ? round(($payment->booking->total_dibayar / $payment->booking->total_pembayaran) * 100, 1) : 0 }}%
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="border rounded p-3 bg-light">
                                            <small class="text-muted d-block">Sisa</small>
                                            <h4
                                                class="{{ $payment->booking->sisa_pembayaran > 0 ? 'text-danger' : 'text-success' }} mb-0">
                                                Rp
                                                {{ number_format($payment->booking->sisa_pembayaran, 0, ',', '.') }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-3" style="height: 10px;">
                                    <div class="progress-bar bg-success"
                                        style="width: {{ $payment->jumlah > 0 ? ($payment->jumlah_dibayar / $payment->jumlah) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Detail Pembayaran
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">ID Pembayaran</td>
                                                <td>#{{ $payment->id }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Midtrans Order ID</td>
                                                <td><code>{{ $payment->midtrans_order_id ?? 'N/A' }}</code></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Jenis Pembayaran</td>
                                                <td>
                                                    @php
                                                        $badgeClass =
                                                            [
                                                                'dp' => 'badge-info',
                                                                'pelunasan' => 'badge-success',
                                                                'bayar_penuh' => 'badge-primary',
                                                                'denda' => 'badge-danger',
                                                            ][$payment->jenis_pembayaran] ?? 'badge-secondary';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->jenis_pembayaran)) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Metode Pembayaran</td>
                                                <td>{{ ucfirst($payment->metode_pembayaran) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">Saluran</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $payment->saluran_pembayaran == 'online' ? 'primary' : 'secondary' }}">
                                                        {{ $payment->saluran_pembayaran == 'online' ? 'Online' : 'Offline' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Dibuat Pada</td>
                                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Dibayar Pada</td>
                                                <td>{{ $payment->dibayar_pada ? $payment->dibayar_pada->format('d/m/Y H:i') : 'Belum dibayar' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Update Terakhir</td>
                                                <td>{{ $payment->updated_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Information -->
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-book mr-2"></i>
                                    Informasi Booking
                                </h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-external-link-alt mr-1"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">ID Transaksi</td>
                                                <td><strong>{{ $payment->booking->id_transaksi ?? 'N/A' }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Nama Penyewa</td>
                                                <td>{{ $payment->booking->nama_penyewa ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">No. Telepon</td>
                                                <td>{{ $payment->booking->no_telp ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Tujuan</td>
                                                <td>{{ $payment->booking->tujuan ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">Status Booking</td>
                                                <td>
                                                    @php
                                                        $bookingStatusClass =
                                                            [
                                                                'approved' => 'badge-success',
                                                                'pending' => 'badge-warning',
                                                                'rejected' => 'badge-danger',
                                                                'completed' => 'badge-info',
                                                                'cancelled' => 'badge-secondary',
                                                            ][$payment->booking->status ?? ''] ?? 'badge-secondary';
                                                    @endphp
                                                    <span class="badge {{ $bookingStatusClass }}">
                                                        {{ ucfirst($payment->booking->status ?? 'N/A') }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Status Pembayaran</td>
                                                <td>
                                                    @php
                                                        $paymentStatusClass =
                                                            [
                                                                'lunas' => 'badge-success',
                                                                'dp_dibayar' => 'badge-primary',
                                                                'menunggu' => 'badge-warning',
                                                                'tertunggak' => 'badge-danger',
                                                            ][$payment->booking->status_pembayaran ?? ''] ??
                                                            'badge-secondary';
                                                    @endphp
                                                    <span class="badge {{ $paymentStatusClass }}">
                                                        {{ ucfirst($payment->booking->status_pembayaran ?? 'N/A') }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Tanggal Mulai</td>
                                                <td>{{ $payment->booking->mulai_tgl ? \Carbon\Carbon::parse($payment->booking->mulai_tgl)->format('d/m/Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Tanggal Selesai</td>
                                                <td>{{ $payment->booking->sel_tgl ? \Carbon\Carbon::parse($payment->booking->sel_tgl)->format('d/m/Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Car Information -->
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-car mr-2"></i>
                                    Informasi Mobil
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">Merk & Model</td>
                                                <td><strong>{{ $payment->booking->car->merk ?? 'N/A' }}
                                                        {{ $payment->booking->car->model ?? '' }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">No. Polisi</td>
                                                <td>{{ $payment->booking->car->no_polisi ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Tahun</td>
                                                <td>{{ $payment->booking->car->tahun ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Warna</td>
                                                <td>{{ $payment->booking->car->warna ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td width="40%" class="text-muted font-weight-bold">Biaya Harian</td>
                                                <td>Rp
                                                    {{ number_format($payment->booking->car->biaya_harian ?? 0, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Kategori</td>
                                                <td>{{ $payment->booking->car->kategori ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Transmisi</td>
                                                <td>{{ $payment->booking->car->transmisi ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted font-weight-bold">Bahan Bakar</td>
                                                <td>{{ $payment->booking->car->bahan_bakar ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Timeline -->
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-history mr-2"></i>
                                    Timeline Pembayaran
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="time-label">
                                        <span class="bg-primary">{{ $payment->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-plus-circle bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i>
                                                {{ $payment->created_at->format('H:i') }}</span>
                                            <h3 class="timeline-header">Pembayaran Dibuat</h3>
                                            <div class="timeline-body">
                                                Pembayaran #{{ $payment->id }} dibuat dengan status
                                                @php
                                                    $bookingStatusClass =
                                                        [
                                                            'lunas' => 'badge-success',
                                                            'dp_dibayar' => 'badge-primary',
                                                            'menunggu' => 'badge-warning',
                                                            'tertunggak' => 'badge-danger',
                                                        ][$payment->booking->status_pembayaran ?? ''] ??
                                                        'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $bookingStatusClass }}">
                                                    {{ ucfirst($payment->booking->status_pembayaran ?? 'N/A') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($payment->dibayar_pada)
                                        <div>
                                            <i class="fas fa-check-circle bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i>
                                                    {{ $payment->dibayar_pada->format('H:i') }}</span>
                                                <h3 class="timeline-header">Pembayaran Berhasil</h3>
                                                <div class="timeline-body">
                                                    Pembayaran dikonfirmasi sebesar Rp
                                                    {{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div>
                                        <i class="fas fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Quick Actions -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-bolt mr-2"></i>
                                    Aksi Cepat
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye mr-1"></i> Lihat Detail Booking
                                    </a>

                                    @if ($payment->status_pembayaran == 'menunggu')
                                        <form action="{{ route('admin.payments.sync', $payment->id) }}" method="POST"
                                            class="d-grid">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('Sync status pembayaran dari Midtrans?')">
                                                <i class="fas fa-sync mr-1"></i> Sync Status Pembayaran
                                            </button>
                                        </form>
                                    @endif

                                    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                        <i class="fas fa-print mr-1"></i> Cetak Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Status Management -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-edit mr-2"></i>
                                    Kelola Status
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.payments.update-status', $payment->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status Pembayaran</label>
                                        <select name="status_pembayaran" class="form-control" required>
                                            <option value="menunggu"
                                                {{ $payment->status_pembayaran == 'menunggu' ? 'selected' : '' }}>Menunggu
                                            </option>
                                            <option value="sukses"
                                                {{ $payment->status_pembayaran == 'sukses' ? 'selected' : '' }}>Sukses
                                            </option>
                                            <option value="gagal"
                                                {{ $payment->status_pembayaran == 'gagal' ? 'selected' : '' }}>Gagal
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="jumlah-dibayar-field" style="display: none;">
                                        <label class="font-weight-bold">Jumlah Dibayar (Rp)</label>
                                        <input type="number" step="1" min="0" name="jumlah_dibayar" id="jumlah_dibayar"
                                            class="form-control" value="{{ old('jumlah_dibayar', $payment->jumlah_dibayar ?? '') }}">
                                        <small class="form-text text-muted">Masukkan jumlah yang diterima (biarkan kosong untuk gunakan nilai total).</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Catatan Admin</label>
                                        <textarea name="catatan_admin" rows="3" class="form-control" placeholder="Catatan untuk pembayaran ini...">{{ $payment->catatan_admin }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">
                                        <i class="fas fa-save mr-1"></i> Update Status
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Financial Summary -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Ringkasan Keuangan
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Total Booking</td>
                                        <td class="text-right">Rp
                                            {{ number_format($payment->booking->total_pembayaran ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Total Dibayar</td>
                                        <td class="text-right text-success">Rp
                                            {{ number_format($payment->booking->total_dibayar ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Sisa Pembayaran</td>
                                        <td
                                            class="text-right {{ ($payment->booking->sisa_pembayaran ?? 0) > 0 ? 'text-danger' : 'text-success' }}">
                                            Rp {{ number_format($payment->booking->sisa_pembayaran ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="font-weight-bold">Status Bayar</td>
                                        <td class="text-right">
                                            @php
                                                $paymentStatusClass =
                                                    [
                                                        'lunas' => 'badge-success',
                                                        'dp_dibayar' => 'badge-primary',
                                                        'menunggu' => 'badge-warning',
                                                        'tertunggak' => 'badge-danger',
                                                    ][$payment->booking->status_pembayaran ?? ''] ?? 'badge-secondary';
                                            @endphp
                                            <span class="badge {{ $paymentStatusClass }}">
                                                {{ ucfirst($payment->booking->status_pembayaran ?? 'N/A') }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        @if ($payment->catatan_admin)
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-sticky-note mr-2"></i>
                                        Catatan Admin
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $payment->catatan_admin }}</p>
                                    <small class="text-muted">Terakhir update:
                                        {{ $payment->updated_at->format('d/m/Y H:i') }}</small>
                                </div>
                            </div>
                        @endif

                        <!-- Danger Zone -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Zona Berbahaya
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted mb-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Hapus pembayaran hanya jika terjadi kesalahan input atau duplikasi data.
                                </p>
                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pembayaran #{{ $payment->id }}? Tindakan ini tidak dapat dibatalkan dan akan mempengaruhi status booking!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm">
                                        <i class="fas fa-trash mr-1"></i> Hapus Pembayaran
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('admin_js')
    <script>
        // Confirmation for status update
        document.querySelector('form[action*="update-status"]').addEventListener('submit', function(e) {
            const newStatus = this.querySelector('select[name="status_pembayaran"]').value;
            const currentStatus = '{{ $payment->status_pembayaran }}';

            if (newStatus !== currentStatus) {
                if (!confirm(`Yakin ingin mengubah status pembayaran dari "${currentStatus}" ke "${newStatus}"?`)) {
                    e.preventDefault();
                }
            }
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Print functionality
        function printPaymentDetail() {
            window.print();
        }

        // Toggle jumlah_dibayar input when status == sukses or if payment is offline
        (function() {
            const form = document.querySelector('form[action*="update-status"]');
            if (!form) return;

            const statusSelect = form.querySelector('select[name="status_pembayaran"]');
            const jumlahField = document.getElementById('jumlah-dibayar-field');
            const jumlahInput = document.getElementById('jumlah_dibayar');
            const paymentJumlah = {{ $payment->jumlah ?? 0 }};
            const isOffline = '{{ $payment->saluran_pembayaran ?? '' }}' === 'offline';

            function refresh() {
                const status = statusSelect.value;
                if (status === 'sukses' && (isOffline || {{ $payment->jenis_pembayaran === 'pelunasan' ? 'true' : 'false' }})) {
                    jumlahField.style.display = 'block';
                    if (!jumlahInput.value) jumlahInput.value = paymentJumlah || '';
                } else {
                    jumlahField.style.display = 'none';
                }
            }

            statusSelect.addEventListener('change', refresh);
            // init
            refresh();
        })();
    </script>
@endsection
