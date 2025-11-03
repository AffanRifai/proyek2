@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manajemen Pembayaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manajemen Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $stats['total'] ?? 0 }}</h3>
                                <p>Total Pembayaran</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <a href="{{ route('admin.payments.index') }}" class="small-box-footer">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $stats['sukses'] ?? 0 }}</h3>
                                <p>Pembayaran Sukses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="{{ route('admin.payments.index', ['status' => 'sukses']) }}"
                                class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $stats['menunggu'] ?? 0 }}</h3>
                                <p>Menunggu Pembayaran</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <a href="{{ route('admin.payments.index', ['status' => 'menunggu']) }}"
                                class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $stats['gagal'] ?? 0 }}</h3>
                                <p>Pembayaran Gagal</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <a href="{{ route('admin.payments.index', ['status' => 'gagal']) }}"
                                class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Filter Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Filter Pembayaran</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select name="status" class="form-control">
                                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status
                                        </option>
                                        <option value="sukses" {{ $status == 'sukses' ? 'selected' : '' }}>Sukses</option>
                                        <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                        </option>
                                        <option value="gagal" {{ $status == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Pembayaran</label>
                                    <select name="jenis" class="form-control">
                                        <option value="all" {{ $jenis == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                                        <option value="dp" {{ $jenis == 'dp' ? 'selected' : '' }}>DP</option>
                                        <option value="pelunasan" {{ $jenis == 'pelunasan' ? 'selected' : '' }}>Pelunasan
                                        </option>
                                        <option value="bayar_penuh" {{ $jenis == 'bayar_penuh' ? 'selected' : '' }}>Bayar
                                            Penuh</option>
                                        <option value="denda" {{ $jenis == 'denda' ? 'selected' : '' }}>Denda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pencarian</label>
                                    <input type="text" name="search" value="{{ $search }}"
                                        placeholder="Cari ID Transaksi / Nama..." class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 32px">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Bulk Actions -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Massal</h3>
                    </div>
                    <div class="card-body">
                        <form id="bulkForm" action="{{ route('admin.payments.bulk-action') }}" method="POST"
                            class="form-inline">
                            @csrf
                            <div class="form-group mr-2">
                                <select name="action" class="form-control" required>
                                    <option value="">Pilih Aksi</option>
                                    <option value="sync_selected">Sync Selected</option>
                                    <option value="delete_selected">Hapus Selected</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-play"></i> Terapkan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Payments Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pembayaran</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="40" class="text-center align-middle">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                        <th class="align-middle">ID</th>
                                        <th class="align-middle">Booking</th>
                                        <th class="align-middle">Jenis</th>
                                        <th class="align-middle text-right">Amount</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">Tanggal</th>
                                        <th class="align-middle text-center" width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($payments as $payment)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" name="selected_payments[]"
                                                    value="{{ $payment->id }}"
                                                    class="form-check-input payment-checkbox">
                                            </td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold text-primary">#{{ $payment->id }}</div>
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">
                                                    {{ Str::limit($payment->midtrans_order_id, 20) }}
                                                </small>
                                            </td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold">
                                                    {{ $payment->booking->id_transaksi ?? 'N/A' }}</div>
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">
                                                    {{ $payment->booking->nama_penyewa ?? 'N/A' }}
                                                </small>
                                                @if ($payment->booking->car)
                                                    <small class="text-info d-block" style="font-size: 0.7rem;">
                                                        <i class="fas fa-car mr-1"></i>
                                                        {{ $payment->booking->car->merk }}
                                                        {{ $payment->booking->car->model }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @php
                                                    $badgeClass =
                                                        [
                                                            'dp' => 'bg-info',
                                                            'pelunasan' => 'bg-success',
                                                            'bayar_penuh' => 'bg-primary',
                                                            'denda' => 'bg-danger',
                                                        ][$payment->jenis_pembayaran] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->jenis_pembayaran)) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-right">
                                                <div class="font-weight-bold text-dark">Rp
                                                    {{ number_format($payment->jumlah, 0, ',', '.') }}</div>
                                                @if ($payment->jumlah_dibayar > 0)
                                                    <small class="text-success d-block" style="font-size: 0.75rem;">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Rp {{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}
                                                    </small>
                                                @else
                                                    <small class="text-warning d-block" style="font-size: 0.75rem;">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Belum dibayar
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @php
                                                    $statusClass =
                                                        [
                                                            'sukses' => 'bg-success',
                                                            'menunggu' => 'bg-warning',
                                                            'gagal' => 'bg-danger',
                                                        ][$payment->status_pembayaran] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }}">
                                                    <i class="fas fa-circle mr-1" style="font-size: 0.5rem;"></i>
                                                    {{ ucfirst($payment->status_pembayaran) }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold">{{ $payment->created_at->format('d/m/Y') }}
                                                </div>
                                                <small class="text-muted d-block" style="font-size: 0.75rem;">
                                                    {{ $payment->created_at->format('H:i') }}
                                                </small>
                                                @if ($payment->dibayar_pada)
                                                    <small class="text-success d-block" style="font-size: 0.7rem;">
                                                        <i class="fas fa-check mr-1"></i>
                                                        {{ $payment->dibayar_pada->format('d/m H:i') }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                        class="btn btn-info" title="Detail Pembayaran"
                                                        data-toggle="tooltip">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if ($payment->status_pembayaran == 'menunggu')
                                                        <form action="{{ route('admin.payments.sync', $payment->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning"
                                                                title="Sync Status" data-toggle="tooltip"
                                                                onclick="return confirm('Yakin ingin sync status pembayaran ini?')">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                                        class="btn btn-success" title="Lihat Booking"
                                                        data-toggle="tooltip">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <h5>Tidak ada data pembayaran</h5>
                                                    <p>Silakan gunakan filter lain atau coba lagi nanti</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-left">
                            <span class="text-muted">
                                Menampilkan {{ $payments->firstItem() ?? 0 }} - {{ $payments->lastItem() ?? 0 }} dari
                                {{ $payments->total() }} data
                            </span>
                        </div>
                        <div class="float-right">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('admin_js')
    <script>
        // Initialize tooltips
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Bulk selection
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.payment-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Bulk form confirmation
        document.getElementById('bulkForm').addEventListener('submit', function(e) {
            const actionSelect = this.querySelector('select[name="action"]');
            const action = actionSelect.value;
            const selected = document.querySelectorAll('.payment-checkbox:checked');

            if (!action) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Aksi',
                    text: 'Silakan pilih aksi terlebih dahulu!'
                });
                return;
            }

            if (selected.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Data',
                    text: 'Pilih setidaknya satu pembayaran!'
                });
                return;
            }

            if (action === 'delete_selected') {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Anda akan menghapus ${selected.length} pembayaran. Tindakan ini tidak dapat dibatalkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endsection
