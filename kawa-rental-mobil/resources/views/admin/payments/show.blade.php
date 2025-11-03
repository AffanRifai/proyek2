@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Pembayaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Manajemen
                                    Pembayaran</a></li>
                            <li class="breadcrumb-item active">Detail Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <!-- Left Column - Payment Information -->
                    <div class="col-md-8">
                        <!-- Payment Information Card -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-credit-card mr-1"></i>
                                    Informasi Pembayaran
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">ID Pembayaran</dt>
                                            <dd class="col-sm-8">#{{ $payment->id }}</dd>

                                            <dt class="col-sm-4">Order ID</dt>
                                            <dd class="col-sm-8">
                                                <code>{{ $payment->midtrans_order_id }}</code>
                                            </dd>

                                            <dt class="col-sm-4">Jenis</dt>
                                            <dd class="col-sm-8">
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
                                            </dd>

                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8">
                                                @php
                                                    $statusClass =
                                                        [
                                                            'sukses' => 'badge-success',
                                                            'menunggu' => 'badge-warning',
                                                            'gagal' => 'badge-danger',
                                                        ][$payment->status_pembayaran] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }}">
                                                    {{ ucfirst($payment->status_pembayaran) }}
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">Jumlah</dt>
                                            <dd class="col-sm-8">
                                                <strong>Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</strong>
                                            </dd>

                                            <dt class="col-sm-4">Dibayar</dt>
                                            <dd class="col-sm-8">
                                                <strong
                                                    class="{{ $payment->jumlah_dibayar > 0 ? 'text-success' : 'text-muted' }}">
                                                    Rp {{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}
                                                </strong>
                                            </dd>

                                            <dt class="col-sm-4">Metode</dt>
                                            <dd class="col-sm-8">{{ ucfirst($payment->metode_pembayaran) }}</dd>

                                            <dt class="col-sm-4">Saluran</dt>
                                            <dd class="col-sm-8">
                                                <span
                                                    class="badge {{ $payment->saluran_pembayaran == 'online' ? 'badge-primary' : 'badge-secondary' }}">
                                                    {{ $payment->saluran_pembayaran == 'online' ? 'Online' : 'Offline' }}
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Information Card -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-book mr-1"></i>
                                    Informasi Booking
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">ID Transaksi</dt>
                                            <dd class="col-sm-8">
                                                <strong>{{ $payment->booking->id_transaksi ?? 'N/A' }}</strong>
                                            </dd>

                                            <dt class="col-sm-4">Nama Penyewa</dt>
                                            <dd class="col-sm-8">{{ $payment->booking->nama_penyewa ?? 'N/A' }}</dd>

                                            <dt class="col-sm-4">No. Telepon</dt>
                                            <dd class="col-sm-8">{{ $payment->booking->no_telp ?? 'N/A' }}</dd>

                                            <dt class="col-sm-4">Status Booking</dt>
                                            <dd class="col-sm-8">
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
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">Status Bayar</dt>
                                            <dd class="col-sm-8">
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
                                            </dd>

                                            <dt class="col-sm-4">Total Booking</dt>
                                            <dd class="col-sm-8">Rp
                                                {{ number_format($payment->booking->total_pembayaran ?? 0, 0, ',', '.') }}
                                            </dd>

                                            <dt class="col-sm-4">Total Dibayar</dt>
                                            <dd class="col-sm-8">
                                                <span class="text-success">
                                                    Rp
                                                    {{ number_format($payment->booking->total_dibayar ?? 0, 0, ',', '.') }}
                                                </span>
                                            </dd>

                                            <dt class="col-sm-4">Sisa</dt>
                                            <dd class="col-sm-8">
                                                <span
                                                    class="{{ ($payment->booking->sisa_pembayaran ?? 0) > 0 ? 'text-danger' : 'text-success' }}">
                                                    Rp
                                                    {{ number_format($payment->booking->sisa_pembayaran ?? 0, 0, ',', '.') }}
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Car Information Card -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-car mr-1"></i>
                                    Informasi Mobil
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">Merk & Model</dt>
                                            <dd class="col-sm-8">
                                                <strong>{{ $payment->booking->car->merk ?? 'N/A' }}
                                                    {{ $payment->booking->car->model ?? '' }}</strong>
                                            </dd>

                                            <dt class="col-sm-4">No. Polisi</dt>
                                            <dd class="col-sm-8">{{ $payment->booking->car->no_polisi ?? 'N/A' }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <dt class="col-sm-4">Tahun</dt>
                                            <dd class="col-sm-8">{{ $payment->booking->car->tahun ?? 'N/A' }}</dd>

                                            <dt class="col-sm-4">Biaya Harian</dt>
                                            <dd class="col-sm-8">Rp
                                                {{ number_format($payment->booking->car->biaya_harian ?? 0, 0, ',', '.') }}
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Midtrans Data Card -->
                        @if ($payment->data_pembayaran)
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-code mr-1"></i>
                                        Data Midtrans
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <pre style="max-height: 300px; overflow-y: auto;" class="bg-dark text-light p-3 rounded"><code>{{ json_encode(json_decode($payment->data_pembayaran), JSON_PRETTY_PRINT) }}</code></pre>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Actions & Timeline -->
                    <div class="col-md-4">
                        <!-- Admin Actions Card -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-tools mr-1"></i>
                                    Aksi Admin
                                </h3>
                            </div>
                            <div class="card-body">
                                <!-- Manual Status Update Form -->
                                <form action="{{ route('admin.payments.update-status', $payment->id) }}" method="POST"
                                    class="mb-3">
                                    @csrf
                                    <div class="form-group">
                                        <label>Update Status Manual</label>
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
                                    <div class="form-group">
                                        <label>Catatan Admin</label>
                                        <textarea name="catatan_admin" rows="3" class="form-control" placeholder="Tambahkan catatan...">{{ $payment->catatan_admin }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">
                                        <i class="fas fa-save mr-1"></i> Update Status
                                    </button>
                                </form>

                                <!-- Quick Actions -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                        class="btn btn-info btn-block">
                                        <i class="fas fa-eye mr-1"></i> Lihat Detail Booking
                                    </a>

                                    @if ($payment->midtrans_order_id)
                                        <a href="/check-transaction-status/{{ $payment->midtrans_order_id }}"
                                            target="_blank" class="btn btn-primary btn-block">
                                            <i class="fas fa-external-link-alt mr-1"></i> Check Midtrans
                                        </a>
                                    @endif

                                    @if ($payment->status_pembayaran == 'menunggu')
                                        <form action="{{ route('admin.payments.sync', $payment->id) }}" method="POST"
                                            class="d-grid">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block"
                                                onclick="return confirm('Yakin ingin sync status pembayaran?')">
                                                <i class="fas fa-sync mr-1"></i> Sync Status
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Card -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-history mr-1"></i>
                                    Timeline
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-plus-circle text-success mr-2"></i>
                                            <span>Dibuat</span>
                                        </div>
                                        <small class="text-muted">{{ $payment->created_at->format('d/m/Y H:i') }}</small>
                                    </li>

                                    @if ($payment->dibayar_pada)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                                <span>Dibayar</span>
                                            </div>
                                            <small
                                                class="text-muted">{{ $payment->dibayar_pada->format('d/m/Y H:i') }}</small>
                                        </li>
                                    @endif

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-edit text-warning mr-2"></i>
                                            <span>Terakhir Update</span>
                                        </div>
                                        <small class="text-muted">{{ $payment->updated_at->format('d/m/Y H:i') }}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Admin Notes Card -->
                        @if ($payment->catatan_admin)
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-sticky-note mr-1"></i>
                                        Catatan Admin
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">{{ $payment->catatan_admin }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Danger Zone Card -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Zona Berbahaya
                                </h3>
                            </div>
                            <div class="card-body">
                                <p class="text-danger text-sm">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Hapus pembayaran hanya jika benar-benar diperlukan.
                                </p>
                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pembayaran ini? Tindakan ini tidak dapat dibatalkan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fas fa-trash mr-1"></i> Hapus Pembayaran
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('admin_js')
    <script>
        // Confirmation for status update
        document.querySelector('form[action*="update-status"]').addEventListener('submit', function(e) {
            const newStatus = this.querySelector('select[name="status_pembayaran"]').value;
            const currentStatus = '{{ $payment->status_pembayaran }}';

            if (newStatus !== currentStatus) {
                if (!confirm(`Yakin ingin mengubah status dari "${currentStatus}" ke "${newStatus}"?`)) {
                    e.preventDefault();
                }
            }
        });
    </script>
@endsection
