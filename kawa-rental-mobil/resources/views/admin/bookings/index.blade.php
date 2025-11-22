@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark fw-bold">Manajemen Booking</h1>
                        <p class="text-muted mt-1">Kelola semua pemesanan kendaraan dengan mudah</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Manajemen Booking</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash Messages - Modern Design -->
                @if (session('success'))
                    <div class="alert alert-success alert-modern alert-dismissible fade show">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="alert-content flex-fill">
                                <h6 class="alert-title">Berhasil!</h6>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-modern alert-dismissible fade show">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content flex-fill">
                                <h6 class="alert-title">Error!</h6>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-modern alert-dismissible fade show">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="alert-content flex-fill">
                                <h6 class="alert-title">Informasi</h6>
                                <p class="mb-0">{{ session('info') }}</p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Statistics Cards - Modern Design -->
                <div class="row mb-4">
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-primary bg-opacity-10">
                                        <i class="fas fa-clipboard-list text-primary"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['total'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-warning bg-opacity-10">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['pending'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Pending</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-success bg-opacity-10">
                                        <i class="fas fa-check text-success"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['approved'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Approved</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-danger bg-opacity-10">
                                        <i class="fas fa-times text-danger"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['rejected'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Rejected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-info bg-opacity-10">
                                        <i class="fas fa-flag-checkered text-info"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['completed'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 mb-3">
                        <div class="stat-card card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-secondary bg-opacity-10">
                                        <i class="fas fa-ban text-secondary"></i>
                                    </div>
                                    <div class="ms-3 flex-fill">
                                        <h4 class="stat-value mb-0 fw-bold">{{ $stats['cancelled'] ?? 0 }}</h4>
                                        <span class="stat-label text-muted">Cancelled</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Alert for Expired Bookings - Modern -->
                @if ($expiredCount > 0)
                    <div class="alert alert-warning alert-modern">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content flex-fill">
                                <h6 class="alert-title">Perhatian!</h6>
                                <p class="mb-0">Ada <strong>{{ $expiredCount }} booking</strong> yang sudah lewat
                                    tanggal selesai dan perlu diproses pengembalian.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Main Card - Modern Design -->
                <div class="card card-modern border-0 shadow-sm">
                    <div class="card-header-modern card-header bg-white border-bottom">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="mb-2 mb-md-0">
                                <h3 class="card-title-modern mb-1">
                                    <i class="fas fa-list me-2 text-primary"></i>
                                    Daftar Booking
                                </h3>
                                <p class="text-muted mb-0 small">Total {{ $bookings->total() }} data booking</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.bookings.index') }}" class="btn btn-refresh" title="Refresh">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <!-- Filter Tabs - Modern & Responsive -->
                        <div class="filter-section p-3 bg-light-subtle border-bottom">
                            <div class="row">
                                <div class="col-12">
                                    <div
                                        class="filter-tabs d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                                        <a href="{{ route('admin.bookings.index', ['status' => 'all']) }}"
                                            class="filter-tab {{ $status == 'all' ? 'active' : '' }}" data-status="all">
                                            <span class="filter-badge">Semua</span>
                                        </a>
                                        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
                                            class="filter-tab {{ $status == 'pending' ? 'active' : '' }}"
                                            data-status="pending">
                                            <span class="filter-badge bg-warning">Pending</span>
                                        </a>
                                        <a href="{{ route('admin.bookings.index', ['status' => 'approved']) }}"
                                            class="filter-tab {{ $status == 'approved' ? 'active' : '' }}"
                                            data-status="approved">
                                            <span class="filter-badge bg-success">Approved</span>
                                        </a>
                                        <a href="{{ route('admin.bookings.index', ['status' => 'rejected']) }}"
                                            class="filter-tab {{ $status == 'rejected' ? 'active' : '' }}"
                                            data-status="rejected">
                                            <span class="filter-badge bg-danger">Rejected</span>
                                        </a>
                                        <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}"
                                            class="filter-tab {{ $status == 'completed' ? 'active' : '' }}"
                                            data-status="completed">
                                            <span class="filter-badge bg-info">Completed</span>
                                        </a>
                                        <a href="{{ route('admin.bookings.index', ['status' => 'cancelled']) }}"
                                            class="filter-tab {{ $status == 'cancelled' ? 'active' : '' }}"
                                            data-status="cancelled">
                                            <span class="filter-badge bg-secondary">Cancelled</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with Modern Design -->
                        <div class="table-modern-container">
                            <div class="table-responsive" style="min-height: 500px;">
                                <table class="table table-modern table-hover mb-0">
                                    <thead class="table-modern-header">
                                        <tr>
                                            <th width="140" class="ps-4">ID Transaksi</th>
                                            <th width="160">Customer</th>
                                            <th width="180">Mobil</th>
                                            <th width="150">Periode</th>
                                            <th width="120">Total</th>
                                            <th width="140">Status Booking</th>
                                            <th width="140">Status Mobil</th>
                                            <th width="140">Status Bayar</th>
                                            <th width="220" class="text-center pe-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr
                                                class="table-modern-row {{ $booking->isExpired() ? 'table-warning' : '' }}">
                                                <!-- ID Transaksi -->
                                                <td class="ps-4">
                                                    <div class="fw-bold text-primary">{{ $booking->id_transaksi }}</div>
                                                    <small
                                                        class="text-muted">{{ $booking->created_at->format('d/m/Y H:i') }}</small>
                                                </td>

                                                <!-- Customer -->
                                                <td>
                                                    <div class="fw-bold text-dark">{{ $booking->nama_penyewa }}</div>
                                                    <small class="text-muted d-block">{{ $booking->no_telp }}</small>
                                                    @if ($booking->email)
                                                        <small class="text-muted">{{ $booking->email }}</small>
                                                    @endif
                                                </td>

                                                <!-- Mobil -->
                                                <td>
                                                    <div class="fw-bold text-dark">{{ $booking->car->merk }}
                                                        {{ $booking->car->model }}</div>
                                                    <small
                                                        class="text-muted d-block">{{ $booking->car->no_polisi }}</small>
                                                    <small class="text-muted">Tahun: {{ $booking->car->tahun }}</small>
                                                </td>

                                                <!-- Periode -->
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-bold text-dark">{{ $booking->mulai_tgl->format('d/m/Y') }}</span>
                                                        <span
                                                            class="fw-bold text-dark">{{ $booking->sel_tgl->format('d/m/Y') }}</span>
                                                        <small class="text-muted">{{ $booking->lama_hari }} hari</small>
                                                    </div>
                                                </td>

                                                <!-- Total -->
                                                <td>
                                                    <div class="fw-bold text-success">
                                                        Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                                                    </div>
                                                    <small
                                                        class="text-muted text-capitalize">{{ $booking->tipe_pembayaran }}</small>
                                                </td>

                                                <!-- Status Booking -->
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'warning',
                                                            'approved' => 'success',
                                                            'rejected' => 'danger',
                                                            'completed' => 'info',
                                                            'cancelled' => 'secondary',
                                                        ];
                                                        $statusColor = $statusColors[$booking->status] ?? 'secondary';
                                                    @endphp
                                                    <span class="status-badge status-{{ $statusColor }}">
                                                        <i
                                                            class="fas
                                                            @if ($booking->status == 'pending') fa-clock
                                                            @elseif($booking->status == 'approved') fa-check
                                                            @elseif($booking->status == 'rejected') fa-times
                                                            @elseif($booking->status == 'completed') fa-flag-checkered
                                                            @else fa-ban @endif
                                                            me-1"></i>
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </td>

                                                <!-- Status Mobil -->
                                                <td>
                                                    @php
                                                        $mobilStatusColors = [
                                                            'normal' => 'success',
                                                            'rusak' => 'danger',
                                                            'dalam_perbaikan' => 'warning',
                                                            'tersedia' => 'info',
                                                        ];
                                                        $mobilStatusColor =
                                                            $mobilStatusColors[$booking->status_mobil] ?? 'secondary';
                                                    @endphp
                                                    <span class="status-badge status-{{ $mobilStatusColor }}">
                                                        <i class="fas fa-car me-1"></i>
                                                        {{ ucfirst(str_replace('_', ' ', $booking->status_mobil)) }}
                                                    </span>
                                                </td>

                                                <!-- Status Bayar -->
                                                <td>
                                                    @php
                                                        $bayarStatusColors = [
                                                            'lunas' => 'success',
                                                            'dp_dibayar' => 'primary',
                                                            'menunggu' => 'warning',
                                                            'tertunggak' => 'danger',
                                                        ];
                                                        $bayarStatusColor =
                                                            $bayarStatusColors[$booking->status_pembayaran] ??
                                                            'secondary';
                                                    @endphp
                                                    <span class="status-badge status-{{ $bayarStatusColor }}">
                                                        <i
                                                            class="fas
                                                            @if ($booking->status_pembayaran == 'lunas') fa-check-circle
                                                            @elseif($booking->status_pembayaran == 'dp_dibayar') fa-money-bill-wave
                                                            @elseif($booking->status_pembayaran == 'menunggu') fa-clock
                                                            @elseif($booking->status_pembayaran == 'tertunggak') fa-exclamation-triangle
                                                            @else fa-question @endif
                                                            me-1"></i>
                                                        {{ ucfirst($booking->status_pembayaran) }}
                                                    </span>

                                                    @if ($booking->ada_denda)
                                                        <div class="status-badge status-danger mt-1">
                                                            <i class="fas fa-money-bill-wave me-1"></i>
                                                            Denda
                                                        </div>
                                                    @endif
                                                </td>

                                                <!-- Aksi dengan Text -->
                                                <td class="pe-4">
                                                    <div class="action-buttons-with-text">
                                                        <!-- Detail Button -->
                                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                            class="btn btn-action-with-text btn-info"
                                                            title="Detail Booking">
                                                            <i class="fas fa-eye me-1"></i>
                                                            <span class="action-text">Detail</span>
                                                        </a>

                                                        @if ($booking->status == 'pending')
                                                            <!-- Approve Button -->
                                                            <form
                                                                action="{{ route('admin.bookings.approve', $booking->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-action-with-text btn-success"
                                                                    onclick="return confirm('Approve booking ini?')"
                                                                    title="Approve Booking">
                                                                    <i class="fas fa-check me-1"></i>
                                                                    <span class="action-text">Approve</span>
                                                                </button>
                                                            </form>

                                                            <!-- Reject Button -->
                                                            <button type="button"
                                                                onclick="showRejectModal({{ $booking->id }})"
                                                                class="btn btn-action-with-text btn-danger"
                                                                title="Tolak Booking">
                                                                <i class="fas fa-times me-1"></i>
                                                                <span class="action-text">Reject</span>
                                                            </button>
                                                        @endif

                                                        @if ($booking->status == 'approved')
                                                            <!-- Complete Button -->
                                                            @if (!$booking->is_terlambat)
                                                                <form
                                                                    action="{{ route('admin.bookings.complete', $booking->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-action-with-text btn-primary"
                                                                        onclick="return confirm('Tandai booking sebagai selesai?')"
                                                                        title="Complete Booking">
                                                                        <i class="fas fa-flag-checkered me-1"></i>
                                                                        <span class="action-text">Complete</span>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <!-- Pengembalian Button -->
                                                            @if ($booking->tombol_pengembalian_aktif)
                                                                <a href="{{ route('admin.bookings.pengembalian', $booking->id) }}"
                                                                    class="btn btn-action-with-text btn-warning"
                                                                    title="Proses Pengembalian">
                                                                    <i class="fas fa-car-side me-1"></i>
                                                                    <span class="action-text">Kembali</span>
                                                                </a>
                                                            @endif

                                                            <!-- Cancel Button -->
                                                            <button type="button"
                                                                onclick="showCancelModal({{ $booking->id }})"
                                                                class="btn btn-action-with-text btn-secondary"
                                                                title="Batalkan Booking">
                                                                <i class="fas fa-ban me-1"></i>
                                                                <span class="action-text">Cancel</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                        <h5 class="text-muted">Tidak ada data booking</h5>
                                                        <p class="text-muted">Data booking akan muncul di sini</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination - Modern -->
                    @if ($bookings->hasPages())
                        <div class="card-footer-modern card-footer bg-white border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    Menampilkan {{ $bookings->firstItem() ?? 0 }} - {{ $bookings->lastItem() ?? 0 }} dari
                                    {{ $bookings->total() }} data
                                </div>
                                <div class="pagination-modern">
                                    {{ $bookings->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-times me-2"></i>Tolak Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                </div>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alasan" class="form-label fw-bold">Alasan Penolakan</label>
                            <textarea id="alasan" name="alasan" rows="4" class="form-control modern-input"
                                placeholder="Berikan alasan penolakan..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-ban me-2"></i>Batalkan Booking
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                </div>
                <form id="cancelForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alasan_cancel" class="form-label fw-bold">Alasan Pembatalan</label>
                            <textarea id="alasan_cancel" name="alasan" rows="4" class="form-control modern-input"
                                placeholder="Berikan alasan pembatalan..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-secondary">Batalkan Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin_js')
    <script>
        // Modal Functions
        function showRejectModal(bookingId) {
            const form = document.getElementById('rejectForm');
            form.action = `/admin/bookings/${bookingId}/reject`;
            $('#rejectModal').modal('show');
        }

        function showCancelModal(bookingId) {
            const form = document.getElementById('cancelForm');
            form.action = `/admin/bookings/${bookingId}/cancel`;
            $('#cancelModal').modal('show');
        }

        // Reset form when modal is closed
        $('#rejectModal').on('hidden.bs.modal', function() {
            document.getElementById('alasan').value = '';
        });

        $('#cancelModal').on('hidden.bs.modal', function() {
            document.getElementById('alasan_cancel').value = '';
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);

        // Add loading state to buttons
        $(document).on('submit', 'form', function() {
            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Loading...');
        });
    </script>

    <style>
        /* Modern Design System */
        :root {
            --primary: #2c7be5;
            --success: #00d97e;
            --warning: #f6c343;
            --danger: #e63757;
            --info: #39afd1;
            --secondary: #6e84a3;
            --light: #f9fbfd;
            --dark: #12263f;
            --border: #e3ebf6;
            --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        /* Modern Cards - Fixed White Background */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white !important;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow) !important;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
            color: var(--dark);
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Modern Alerts */
        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow);
            background: white;
        }

        .alert-modern .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .alert-success .alert-icon {
            background: rgba(0, 217, 126, 0.1);
            color: var(--success);
        }

        .alert-danger .alert-icon {
            background: rgba(230, 55, 87, 0.1);
            color: var(--danger);
        }

        .alert-info .alert-icon {
            background: rgba(57, 175, 209, 0.1);
            color: var(--info);
        }

        .alert-warning .alert-icon {
            background: rgba(246, 195, 67, 0.1);
            color: var(--warning);
        }

        .alert-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        /* Modern Table */
        .card-modern {
            border-radius: 16px;
            overflow: hidden;
            background: white;
        }

        .card-header-modern {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            background: white !important;
        }

        .card-title-modern {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.25rem;
        }

        .table-modern-container {
            border-radius: 0 0 16px 16px;
            overflow: hidden;
        }

        .table-modern {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
        }

        .table-modern-header {
            background: var(--light);
        }

        .table-modern-header th {
            border: none;
            padding: 1rem 0.75rem;
            font-weight: 600;
            color: var(--secondary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-modern-row td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            background: white;
        }

        .table-modern-row:last-child td {
            border-bottom: none;
        }

        .table-modern-row:hover {
            background-color: #f8fafc;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-success {
            background: rgba(0, 217, 126, 0.1);
            color: var(--success);
        }

        .status-warning {
            background: rgba(246, 195, 67, 0.1);
            color: var(--warning);
        }

        .status-danger {
            background: rgba(230, 55, 87, 0.1);
            color: var(--danger);
        }

        .status-info {
            background: rgba(57, 175, 209, 0.1);
            color: var(--info);
        }

        .status-primary {
            background: rgba(44, 123, 229, 0.1);
            color: var(--primary);
        }

        .status-secondary {
            background: rgba(110, 132, 163, 0.1);
            color: var(--secondary);
        }

        .status-expired {
            background: rgba(230, 55, 87, 0.1);
            color: var(--danger);
        }

        /* Action Buttons with Text */
        .action-buttons-with-text {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-action-with-text {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            border: none;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            width: 100%;
            justify-content: flex-start;
        }

        .btn-action-with-text:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .action-text {
            margin-left: 0.25rem;
        }

        /* Filter Tabs - Responsive */
        .filter-section {
            background: var(--light) !important;
        }

        .filter-tabs {
            gap: 0.5rem;
        }

        .filter-tab {
            text-decoration: none;
            transition: all 0.2s ease;
            flex: 1;
            min-width: calc(50% - 0.5rem);
        }

        .filter-tab.active .filter-badge {
            background: var(--primary) !important;
            color: white;
            box-shadow: 0 2px 4px rgba(44, 123, 229, 0.3);
        }

        .filter-badge {
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.75rem;
            transition: all 0.2s ease;
            background: white;
            color: var(--secondary);
            border: 1px solid var(--border);
            display: block;
            text-align: center;
            width: 100%;
        }

        .filter-tab:hover .filter-badge {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Refresh Button */
        .btn-refresh {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-refresh:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 1rem;
        }

        /* Modern Input */
        .modern-input {
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: 0.75rem;
            transition: all 0.2s ease;
        }

        .modern-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(44, 123, 229, 0.1);
        }

        /* Pagination Modern */
        .pagination-modern .pagination {
            margin-bottom: 0;
        }

        .pagination-modern .page-link {
            border: none;
            border-radius: 8px;
            margin: 0 0.25rem;
            color: var(--secondary);
            font-weight: 500;
        }

        .pagination-modern .page-item.active .page-link {
            background: var(--primary);
            color: white;
        }

        /* Responsive Design - Improved */
        @media (max-width: 768px) {
            .card-header-modern {
                padding: 1rem;
            }

            .table-modern-header th,
            .table-modern-row td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8125rem;
            }

            .btn-action-with-text {
                padding: 0.375rem 0.5rem;
                font-size: 0.7rem;
            }

            .action-text {
                display: inline-block;
            }

            .filter-tabs {
                gap: 0.375rem;
            }

            .filter-badge {
                padding: 0.375rem 0.5rem;
                font-size: 0.7rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            /* 2 cards per row on mobile */
            .col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .table-responsive {
                font-size: 0.75rem;
            }

            .status-badge {
                padding: 0.25rem 0.5rem;
                font-size: 0.6875rem;
            }

            .card-title-modern {
                font-size: 1.125rem;
            }

            .filter-tabs {
                justify-content: center;
            }

            .filter-tab {
                flex: 0 0 calc(50% - 0.375rem);
                min-width: calc(50% - 0.375rem);
            }

            .filter-badge {
                width: 100%;
                text-align: center;
            }

            .btn-action-with-text {
                justify-content: center;
                padding: 0.5rem;
            }

            .action-buttons-with-text {
                gap: 0.375rem;
            }
        }

        @media (max-width: 400px) {
            .filter-tab {
                flex: 0 0 100%;
                min-width: 100%;
            }

            .col-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Ensure white background for all cards */
        .card {
            background: white !important;
        }

        .bg-light-subtle {
            background-color: #f8f9fa !important;
        }
    </style>
@endsection
