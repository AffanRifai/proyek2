@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark fw-bold">Detail Booking</h1>
                        <p class="text-muted mt-1 small">ID Transaksi: <strong>{{ $booking->id_transaksi }}</strong></p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right small">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Manajemen Booking</a>
                            </li>
                            <li class="breadcrumb-item active">Detail Booking</li>
                        </ol>
                    </div>
                </div>

                <!-- Summary Info Boxes (ringkasan) -->
                <div class="row gx-3 gy-3">
                    <div class="col-sm-4">
                        <div class="summary-card">
                            <div class="summary-left">
                                <i class="fas fa-calendar-alt summary-icon"></i>
                            </div>
                            <div class="summary-right">
                                <div class="summary-label">Periode Sewa</div>
                                <div class="summary-value">
                                    {{ $booking->mulai_tgl->format('d M Y') }} - {{ $booking->sel_tgl->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="summary-card">
                            <div class="summary-left">
                                <i class="fas fa-wallet summary-icon"></i>
                            </div>
                            <div class="summary-right">
                                <div class="summary-label">Total Pembayaran</div>
                                <div class="summary-value">Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="summary-card">
                            <div class="summary-left">
                                <i class="fas fa-info-circle summary-icon"></i>
                            </div>
                            <div class="summary-right">
                                <div class="summary-label">Status</div>
                                <div class="summary-value">
                                    <span class="status-badge {{ $booking->status_badge }}">
                                        {!! $booking->status == 'pending'
                                            ? '<i class="fas fa-clock me-1"></i>'
                                            : ($booking->status == 'approved'
                                                ? '<i class="fas fa-check me-1"></i>'
                                                : '') !!}
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Summary Info Boxes -->
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Flash Messages -->
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

                <!-- Header Actions -->
                <div class="card card-modern border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="mb-3 mb-md-0">
                                <h3 class="card-title-modern mb-1">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>
                                    Detail Booking
                                </h3>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <span class="status-badge {{ $booking->status_badge }}">
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
                                    <span class="text-muted">•</span>
                                    <span class="text-muted">ID: {{ $booking->id_transaksi }}</span>
                                    <span class="text-muted">•</span>
                                    <span class="text-muted">Dibuat: {{ $booking->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('admin.bookings.index') }}"
                                    class="btn btn-action-with-text btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    <span class="action-text">Kembali</span>
                                </a>

                                @if ($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-action-with-text btn-success"
                                            onclick="return confirm('Approve booking ini?')">
                                            <i class="fas fa-check me-1"></i>
                                            <span class="action-text">Approve</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <!-- Customer Info Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    Informasi Customer
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Nama Penyewa</label>
                                        <p class="form-value-modern">{{ $booking->nama_penyewa }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">No. Telepon</label>
                                        <p class="form-value-modern">{{ $booking->no_telp }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label-modern">Alamat</label>
                                        <p class="form-value-modern">{{ $booking->alamat }}</p>
                                    </div>
                                    @if ($booking->nama_supir)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-modern">Nama Supir</label>
                                            <p class="form-value-modern">{{ $booking->nama_supir }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-modern">Telp Supir</label>
                                            <p class="form-value-modern">{{ $booking->telp_supir }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                    Detail Booking
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Tanggal Mulai</label>
                                        <p class="form-value-modern">
                                            {{ $booking->mulai_tgl->format('d/m/Y') }} {{ $booking->mulai_pkl }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Tanggal Selesai</label>
                                        <p class="form-value-modern">
                                            {{ $booking->sel_tgl->format('d/m/Y') }} {{ $booking->sel_pkl }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Lama Sewa</label>
                                        <p class="form-value-modern">{{ $booking->lama_hari }} hari</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Tujuan</label>
                                        <p class="form-value-modern">{{ $booking->tujuan }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Bentuk Jaminan</label>
                                        <p class="form-value-modern">{{ ucfirst($booking->bentuk_jaminan) }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Posisi BBM</label>
                                        <p class="form-value-modern">{{ $booking->posisi_bbm }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Car Info Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-car me-2 text-primary"></i>
                                    Informasi Mobil
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Merk & Model</label>
                                        <p class="form-value-modern fw-bold">{{ $booking->car->merk }}
                                            {{ $booking->car->model }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">No. Polisi</label>
                                        <p class="form-value-modern">{{ $booking->car->no_polisi }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Tahun</label>
                                        <p class="form-value-modern">{{ $booking->car->tahun }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Warna</label>
                                        <p class="form-value-modern">{{ $booking->car->warna }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Status Mobil</label>
                                        <div class="mt-1">
                                            <span
                                                class="status-badge {{ $booking->car->status == 'tersedia' ? 'status-success' : 'status-danger' }}">
                                                <i class="fas fa-car me-1"></i>
                                                {{ ucfirst($booking->car->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Keterlambatan & Denda Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    Informasi Keterlambatan & Denda
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-modern">Status Mobil</label>
                                        <div class="mt-1">
                                            <span class="status-badge {{ $booking->status_mobil_badge }}">
                                                {{ ucfirst($booking->status_mobil) }}
                                            </span>
                                        </div>
                                    </div>

                                    @if ($booking->hari_terlambat > 0)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-modern">Hari Terlambat</label>
                                            <p class="form-value-modern text-danger fw-bold">
                                                {{ $booking->hari_terlambat }} hari
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-modern">Denda Terlambat</label>
                                            <p class="form-value-modern text-danger fw-bold">
                                                Rp {{ number_format($booking->denda_terlambat, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    @endif

                                    <div class="col-12 mb-3">
                                        <label class="form-label-modern">Keterangan Terlambat</label>
                                        <p
                                            class="form-value-modern {{ $booking->keterangan_terlambat ? '' : 'text-muted' }}">
                                            {{ $booking->keterangan_terlambat ?: 'Tidak ada keterangan' }}
                                        </p>
                                    </div>

                                    @if ($booking->status == 'cancelled' && $booking->catatan_admin)
                                        <div class="col-12">
                                            <label class="form-label-modern">Catatan Admin (Pembatalan)</label>
                                            <div class="alert-modern alert-warning mt-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="alert-icon">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                    </div>
                                                    <div class="alert-content flex-fill">
                                                        <p class="mb-0">{{ $booking->catatan_admin }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-4">
                        <!-- Status & Payment Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-chart-bar me-2 text-primary"></i>
                                    Status & Pembayaran
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label-modern">Status Booking</label>
                                        <div class="mt-1">
                                            <span class="status-badge {{ $booking->status_badge }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label-modern">Status Real-time</label>
                                        <div class="mt-1">
                                            <span class="status-badge {{ $booking->status_utama_badge }}">
                                                {!! $booking->status_utama['icon'] !!} {{ $booking->status_utama['text'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label-modern">Tipe Pembayaran</label>
                                        <p class="form-value-modern">{{ ucfirst($booking->tipe_pembayaran) }}</p>
                                    </div>
                                    <div>
                                        <label class="form-label-modern">Biaya Harian</label>
                                        <p class="form-value-modern">Rp
                                            {{ number_format($booking->biaya_harian, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <label class="form-label-modern">Total Pembayaran</label>
                                        <p class="form-value-modern text-success fw-bold fs-5">
                                            Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Files Card -->
                        <div class="card card-modern border-0 shadow-sm mb-4">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>
                                    Dokumen
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label-modern">File Identitas</label>
                                        <div class="mt-1 d-flex gap-2">
                                            <a href="{{ route('admin.bookings.view-file', [$booking->id, 'identitas']) }}"
                                                target="_blank" class="btn btn-action-with-text btn-info btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                <span class="action-text">Lihat</span>
                                            </a>
                                            <a href="{{ route('admin.bookings.download-file', [$booking->id, 'identitas']) }}"
                                                class="btn btn-action-with-text btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>
                                                <span class="action-text">Download</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label-modern">File Jaminan</label>
                                        <div class="mt-1 d-flex gap-2">
                                            <a href="{{ route('admin.bookings.view-file', [$booking->id, 'jaminan']) }}"
                                                target="_blank" class="btn btn-action-with-text btn-info btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                <span class="action-text">Lihat</span>
                                            </a>
                                            <a href="{{ route('admin.bookings.download-file', [$booking->id, 'jaminan']) }}"
                                                class="btn btn-action-with-text btn-success btn-sm">
                                                <i class="fas fa-download me-1"></i>
                                                <span class="action-text">Download</span>
                                            </a>
                                        </div>
                                    </div>

                                    @if ($booking->file_stnk_motor)
                                        <div>
                                            <label class="form-label-modern">File STNK Motor</label>
                                            <div class="mt-1 d-flex gap-2">
                                                <a href="{{ route('admin.bookings.view-file', [$booking->id, 'stnk']) }}"
                                                    target="_blank" class="btn btn-action-with-text btn-info btn-sm">
                                                    <i class="fas fa-eye me-1"></i>
                                                    <span class="action-text">Lihat</span>
                                                </a>
                                                <a href="{{ route('admin.bookings.download-file', [$booking->id, 'stnk']) }}"
                                                    class="btn btn-action-with-text btn-success btn-sm">
                                                    <i class="fas fa-download me-1"></i>
                                                    <span class="action-text">Download</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Admin Actions Card -->
                        <div class="card card-modern border-0 shadow-sm">
                            <div class="card-header-modern card-header bg-white">
                                <h4 class="card-title-modern mb-0">
                                    <i class="fas fa-cogs me-2 text-primary"></i>
                                    Aksi Admin
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="space-y-2">
                                    @if ($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <button type="submit" class="btn btn-action-with-text btn-success w-100">
                                                <i class="fas fa-check me-1"></i>
                                                <span class="action-text">Approve Booking</span>
                                            </button>
                                        </form>

                                        <button onclick="showRejectModal()"
                                            class="btn btn-action-with-text btn-danger w-100">
                                            <i class="fas fa-times me-1"></i>
                                            <span class="action-text">Tolak Booking</span>
                                        </button>
                                    @endif

                                    @if ($booking->status == 'approved')
                                        <!-- Tombol Complete Manual -->
                                        @if (!$booking->is_terlambat)
                                            <form action="{{ route('admin.bookings.complete', $booking->id) }}"
                                                method="POST" class="w-full">
                                                @csrf
                                                <button type="submit" class="btn btn-action-with-text btn-primary w-100"
                                                    onclick="return confirm('Tandai booking sebagai selesai? Mobil dikembalikan tepat waktu.')">
                                                    <i class="fas fa-flag-checkered me-1"></i>
                                                    <span class="action-text">Tandai Selesai</span>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Pengembalian dengan Denda -->
                                        @if ($booking->tombol_pengembalian_aktif)
                                            <a href="{{ route('admin.bookings.pengembalian', $booking->id) }}"
                                                class="btn btn-action-with-text btn-warning w-100">
                                                <i class="fas fa-car-side me-1"></i>
                                                <span class="action-text">Proses Pengembalian</span>
                                            </a>
                                        @endif

                                        <!-- Tombol Cancel -->
                                        <button onclick="showCancelModal()"
                                            class="btn btn-action-with-text btn-secondary w-100">
                                            <i class="fas fa-ban me-1"></i>
                                            <span class="action-text">Batalkan Booking</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
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
                <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST">
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
        function showRejectModal() {
            $('#rejectModal').modal('show');
        }

        function showCancelModal() {
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
        /* ---------------------------
               Color & Font variables
               --------------------------- */
        :root {
            --primary: #2c7be5;
            /* biru utama */
            --muted: #6b7280;
            /* abu lembut */
            --bg: #ffffff;
            --card: #ffffff;
            --border: #e9eef6;
            --soft: #f6f9fc;
            --success: #00d97e;
            --danger: #e63757;
            --shadow: 0 6px 18px rgba(18, 38, 63, 0.06);
            --radius: 12px;
            --font-sans: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        /* Import modern font (will fallback if not available) */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body,
        .content-wrapper {
            font-family: var(--font-sans);
            background: linear-gradient(180deg, var(--soft) 0%, rgba(246, 249, 253, 0.6) 100%);
        }

        /* ---------------------------
               Summary Cards (ringkasan atas)
               Minimal, flat, compact
               --------------------------- */
        .summary-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: none;
            transition: transform .12s ease, box-shadow .12s ease;
        }

        .summary-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .summary-left {
            width: 46px;
            height: 46px;
            border-radius: 8px;
            background: rgba(44, 123, 229, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .summary-icon {
            font-size: 18px;
            color: var(--primary);
        }

        .summary-label {
            font-size: 0.78rem;
            color: var(--muted);
            margin-bottom: 2px;
            font-weight: 600;
            text-transform: none;
        }

        .summary-value {
            font-size: 1rem;
            color: var(--dark, #102a43);
            font-weight: 700;
        }

        /* ---------------------------
               Modern Cards
               (tweak dari style lama, lebih flat)
               --------------------------- */
        .card-modern {
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--card);
            border: 1px solid var(--border);
        }

        .card-header-modern {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            background: transparent !important;
        }

        .card-body {
            padding: 1rem 1.25rem;
        }

        .card-title-modern {
            font-weight: 600;
            color: var(--primary);
            font-size: 1rem;
        }

        /* ---------------------------
               Form Labels & Values
               --------------------------- */
        .form-label-modern {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 0.25rem;
        }

        .form-value-modern {
            font-size: 0.97rem;
            color: #0f2b46;
            margin-bottom: 0;
            word-break: break-word;
        }

        /* ---------------------------
               Status Badges (flat)
               --------------------------- */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .status-success {
            background: rgba(0, 217, 126, 0.09);
            color: var(--success);
        }

        .status-warning {
            background: rgba(246, 195, 67, 0.07);
            color: #b07a00;
        }

        .status-danger {
            background: rgba(230, 55, 87, 0.08);
            color: var(--danger);
        }

        .status-info {
            background: rgba(57, 175, 209, 0.08);
            color: #0b7fa1;
        }

        .status-primary {
            background: rgba(44, 123, 229, 0.08);
            color: var(--primary);
        }

        .status-secondary {
            background: rgba(110, 132, 163, 0.06);
            color: var(--muted);
        }

        /* ---------------------------
               Buttons (flat, subtle shadow on hover)
               --------------------------- */
        .btn-action-with-text {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background: transparent;
            color: #0f2b46;
            transition: transform .12s ease, box-shadow .12s ease;
            text-decoration: none;
        }

        .btn-action-with-text i {
            opacity: 0.9;
        }

        .btn-action-with-text.btn-sm {
            padding: 6px 10px;
            font-size: .82rem;
        }

        .btn-action-with-text.btn-secondary {
            background: rgba(110, 132, 163, 0.06);
            color: #0f2b46;
        }

        .btn-action-with-text.btn-success {
            background: rgba(0, 217, 126, 0.08);
            color: var(--success);
        }

        .btn-action-with-text.btn-danger {
            background: rgba(230, 55, 87, 0.08);
            color: var(--danger);
        }

        .btn-action-with-text.btn-info {
            background: rgba(57, 175, 209, 0.08);
            color: #0b7fa1;
        }

        .btn-action-with-text.btn-primary {
            background: rgba(44, 123, 229, 0.12);
            color: var(--primary);
        }

        .btn-action-with-text:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
            text-decoration: none;
            color: inherit;
        }

        .btn-action-with-text.w-100 {
            width: 100%;
            justify-content: center;
        }

        /* small utility tweaks */
        .space-y-3>*+* {
            margin-top: .75rem;
        }

        .space-y-2>*+* {
            margin-top: .5rem;
        }

        /* ---------------------------
               Modern Alerts
               --------------------------- */
        .alert-modern {
            border: none;
            border-radius: 10px;
            padding: .9rem 1rem;
            box-shadow: var(--shadow);
            background: var(--card);
        }

        .alert-modern .alert-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: .8rem;
            flex-shrink: 0;
        }

        /* ---------------------------
               Input focus / modal buttons
               --------------------------- */
        .modern-input {
            width: 100%;
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: .65rem;
            transition: box-shadow .12s ease, border-color .12s ease;
            background: #fff;
        }

        .modern-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 6px 20px rgba(44, 123, 229, 0.08);
        }

        /* ---------------------------
               Responsiveness
               --------------------------- */
        @media (max-width: 768px) {
            .summary-card {
                padding: 12px;
                gap: 10px;
            }

            .summary-left {
                width: 44px;
                height: 44px;
            }

            .summary-value {
                font-size: 0.95rem;
            }

            .card-body {
                padding: .9rem;
            }
        }

        @media (max-width: 576px) {
            .summary-card {
                flex-direction: row;
            }

            .btn-action-with-text {
                width: 100%;
                justify-content: center;
            }
        }

        /* ---------------------------
               Small helpers (preserve existing class usage)
               --------------------------- */
        .fs-5 {
            font-size: 1.25rem !important;
        }

        .w-100 {
            width: 100% !important;
        }
    </style>
@endsection
