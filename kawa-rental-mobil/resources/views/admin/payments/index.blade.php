@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0 text-primary font-weight-bold">
                        <i class="fas fa-money-check-alt mr-2"></i> Manajemen Pembayaran
                    </h1>
                    <ol class="breadcrumb float-sm-right bg-white px-3 py-2 rounded shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Statistik -->
                <div class="row">
                    @php
                        $cards = [
                            [
                                'color' => 'info',
                                'icon' => 'fa-credit-card',
                                'label' => 'Total Pembayaran',
                                'count' => $stats['total'] ?? 0,
                            ],
                            [
                                'color' => 'success',
                                'icon' => 'fa-check-circle',
                                'label' => 'Pembayaran Sukses',
                                'count' => $stats['sukses'] ?? 0,
                            ],
                            [
                                'color' => 'warning',
                                'icon' => 'fa-clock',
                                'label' => 'Menunggu Pembayaran',
                                'count' => $stats['menunggu'] ?? 0,
                            ],
                            [
                                'color' => 'danger',
                                'icon' => 'fa-times-circle',
                                'label' => 'Pembayaran Gagal',
                                'count' => $stats['gagal'] ?? 0,
                            ],
                        ];
                    @endphp

                    @foreach ($cards as $c)
                        <div class="col-lg-3 col-6 mb-3">
                            <div class="small-box bg-gradient-{{ $c['color'] }} shadow-sm rounded-lg">
                                <div class="inner">
                                    <h3>{{ $c['count'] }}</h3>
                                    <p>{{ $c['label'] }}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas {{ $c['icon'] }}"></i>
                                </div>
                                <a href="{{ route('admin.payments.index') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Filter -->
                <div class="card card-outline card-primary shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-filter mr-2"></i>Filter Pembayaran</h3>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-sm btn-light border">
                            <i class="fas fa-redo-alt"></i> Reset
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-medium">Status</label>
                                <select name="status" class="form-control">
                                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="sukses" {{ $status == 'sukses' ? 'selected' : '' }}>Sukses</option>
                                    <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="gagal" {{ $status == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-medium">Jenis Pembayaran</label>
                                <select name="jenis" class="form-control">
                                    <option value="all" {{ $jenis == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                                    <option value="dp" {{ $jenis == 'dp' ? 'selected' : '' }}>DP</option>
                                    <option value="pelunasan" {{ $jenis == 'pelunasan' ? 'selected' : '' }}>Pelunasan
                                    </option>
                                    <option value="bayar_penuh" {{ $jenis == 'bayar_penuh' ? 'selected' : '' }}>Bayar Penuh
                                    </option>
                                    <option value="denda" {{ $jenis == 'denda' ? 'selected' : '' }}>Denda</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-medium">Pencarian</label>
                                <input type="text" name="search" value="{{ $search }}"
                                    placeholder="Cari ID Transaksi / Nama..." class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i> Terapkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h3 class="card-title font-weight-bold text-primary">
                            <i class="fas fa-table mr-2"></i>Daftar Pembayaran
                        </h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0 align-middle text-nowrap">
                                <thead class="bg-primary text-white text-center">
                                    <tr>
                                        <th style="width: 60px;">ID</th>
                                        <th style="width: 180px;">Booking</th>
                                        <th style="width: 120px;">Jenis</th>
                                        <th style="width: 150px;" class="text-right">Amount</th>
                                        <th style="width: 120px;">Status</th>
                                        <th style="width: 160px;">Tanggal</th>
                                        <th style="width: 220px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($payments as $payment)
                                        <tr>
                                            <td class="align-middle text-primary font-weight-bold text-center">
                                                #{{ $payment->id }}</td>

                                            <td class="align-middle">
                                                <div class="font-weight-bold">
                                                    {{ $payment->booking->id_transaksi ?? 'N/A' }}</div>
                                                <small
                                                    class="text-muted">{{ $payment->booking->nama_penyewa ?? 'N/A' }}</small>
                                            </td>

                                            <td class="align-middle text-center">
                                                @php
                                                    $badgeClass =
                                                        [
                                                            'dp' => 'badge-info',
                                                            'pelunasan' => 'badge-success',
                                                            'bayar_penuh' => 'badge-primary',
                                                            'denda' => 'badge-danger',
                                                        ][$payment->jenis_pembayaran] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge badge-pill {{ $badgeClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->jenis_pembayaran)) }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-right font-weight-bold">
                                                Rp {{ number_format($payment->jumlah, 0, ',', '.') }}
                                            </td>

                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass =
                                                        [
                                                            'sukses' => 'badge-success',
                                                            'menunggu' => 'badge-warning',
                                                            'gagal' => 'badge-danger',
                                                        ][$payment->status_pembayaran] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge badge-pill {{ $statusClass }}">
                                                    {{ ucfirst($payment->status_pembayaran) }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-center">
                                                {{ $payment->created_at->format('d/m/Y H:i') }}
                                            </td>

                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                                    <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                        class="btn btn-sm btn-outline-primary d-flex align-items-center px-2 m-1">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </a>

                                                    {{-- @if ($payment->status_pembayaran == 'menunggu')
                                                        <form action="{{ route('admin.payments.sync', $payment->id) }}"
                                                            method="POST" class="d-inline m-1">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-warning">
                                                                <i class="fas fa-sync-alt"></i> Sinkronkan
                                                            </button>
                                                        </form>
                                                    @endif --}}

                                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                                        class="btn btn-sm btn-outline-success d-flex align-items-center px-2 m-1">
                                                        <i class="fas fa-book mr-1"></i> Lihat Booking
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                                <div>Tidak ada data pembayaran</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div
                        class="card-footer bg-white d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <small class="text-muted mb-2 mb-md-0">
                            Menampilkan {{ $payments->firstItem() ?? 0 }} - {{ $payments->lastItem() ?? 0 }} dari
                            {{ $payments->total() }} data
                        </small>
                        <div>{{ $payments->links() }}</div>
                    </div>
                </div>

                @section('admin_css')
                    <style>
                        /* Perataan tabel yang lebih presisi */
                        .table th,
                        .table td {
                            vertical-align: middle !important;
                            padding: 12px 16px !important;
                        }

                        /* Tombol aksi clean dan sejajar */
                        .table .btn {
                            font-weight: 500;
                            border-radius: 6px;
                            transition: all 0.2s ease-in-out;
                        }

                        .table .btn:hover {
                            transform: translateY(-1px);
                        }

                        /* Responsif untuk mobile */
                        @media (max-width: 768px) {
                            .table-responsive {
                                font-size: 13px;
                            }

                            .table th,
                            .table td {
                                padding: 8px 10px !important;
                            }

                            .table .btn {
                                width: 100%;
                                margin: 3px 0;
                                justify-content: center;
                            }
                        }
                    </style>
                @endsection


            </div>
        </section>
    </div>
@endsection

@section('admin_js')
    <script>
        $(function() {
            setTimeout(() => $('.alert').fadeOut('slow'), 5000);
        });
    </script>
@endsection

@section('admin_css')
    <style>
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 14px;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
            }

            .gap-2>* {
                margin: 4px 0;
            }
        }
    </style>
@endsection
