@extends('layout.master')

@section('admin_content')
    <div class="content-wrapper">

        {{-- =====================
        HEADER
    ===================== --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                        <small class="text-muted">Ringkasan aktivitas rental mobil</small>
                    </div>
                </div>
            </div>
        </section>

        {{-- =====================
        MAIN CONTENT
    ===================== --}}
        <section class="content">
            <div class="container-fluid">

                {{-- =====================
                KPI BOX
            ===================== --}}
                <div class="row">

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalBooking ?? 0 }}</h3>
                                <p>Total Booking</p>
                            </div>
                            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $bookingPending ?? 0 }}</h3>
                                <p>Booking Pending</p>
                            </div>
                            <div class="icon"><i class="far fa-clock"></i></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    Rp {{ number_format($pendapatanBulanIni ?? 0, 0, ',', '.') }}
                                </h3>
                                <p>Pendapatan Bulan Ini</p>
                            </div>
                            <div class="icon"><i class="fas fa-wallet"></i></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $mobilTersedia ?? 0 }}</h3>
                                <p>Mobil Tersedia</p>
                            </div>
                            <div class="icon"><i class="fas fa-car"></i></div>
                        </div>
                    </div>

                </div>

                {{-- =====================
                PINTASAN CEPAT ADMIN
            ===================== --}}
                <div class="row mt-3">

                    {{-- PINTASAN MANAJEMEN MOBIL --}}
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card shadow-sm border-left border-primary">
                            <div class="card-body d-flex align-items-center">
                                <div class="mr-3">
                                    <span
                                        class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:60px;height:60px;">
                                        <i class="fas fa-car fa-2x"></i>
                                    </span>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Manajemen Mobil</h5>
                                    <small class="text-muted">
                                        Kelola data mobil, harga, dan status ketersediaan
                                    </small>
                                </div>

                                <div>
                                    <a href="{{ route('admin.mobil.index') }}" class="btn btn-outline-primary btn-sm">
                                        Buka
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PINTASAN MANAJEMEN BOOKING --}}
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card shadow-sm border-left border-success">
                            <div class="card-body d-flex align-items-center">
                                <div class="mr-3">
                                    <span
                                        class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                        style="width:60px;height:60px;">
                                        <i class="fas fa-clipboard-check fa-2x"></i>
                                    </span>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Manajemen Booking</h5>
                                    <small class="text-muted">
                                        Lihat, approve, reject, dan selesaikan booking
                                    </small>
                                </div>

                                <div>
                                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-success btn-sm">
                                        Buka
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                {{-- =====================
                GRAFIK
            ===================== --}}
                <div class="row mt-4">

                    {{-- BOOKING --}}
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <strong>
                                    <i class="fas fa-car mr-1"></i>
                                    Aktivitas Booking Minggu Ini
                                </strong>
                            </div>

                            <div class="px-3 pt-2">
                                <span class="badge badge-light text-primary">
                                    Total minggu ini: {{ $booking7Hari->sum('total') }} booking
                                </span>
                            </div>

                            <div class="card-body" style="height:260px;">
                                <canvas id="bookingChart"></canvas>
                            </div>

                            <div class="card-footer text-muted">
                                Hari paling ramai:
                                <strong>
                                    {{ \Carbon\Carbon::parse(optional($booking7Hari->sortByDesc('total')->first())->tanggal)->translatedFormat('l, d F') ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    {{-- PENDAPATAN --}}
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <strong>
                                    <i class="fas fa-wallet mr-1"></i>
                                    Pendapatan Minggu Ini
                                </strong>
                            </div>

                            <div class="px-3 pt-2">
                                <span class="badge badge-light text-success">
                                    Total minggu ini:
                                    Rp {{ number_format($pendapatanMingguan->sum('total') ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="card-body" style="height:260px;">
                                <canvas id="pendapatanChart"></canvas>
                            </div>

                            <div class="card-footer text-muted">
                                Transaksi terakhir:
                                <strong>
                                    {{ \Carbon\Carbon::parse(optional($pendapatanMingguan->last())->tanggal)->translatedFormat('l, d F') ?? '-' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection

{{-- =====================
    STYLE
===================== --}}
@push('styles')
    <style>
        .small-box {
            border-radius: 14px;
        }
    </style>
@endpush

{{-- =====================
    SCRIPT GRAFIK
===================== --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const bookingLabels = {!! json_encode($booking7Hari->pluck('tanggal')) !!};
        const bookingData = {!! json_encode($booking7Hari->pluck('total')) !!};

        const pendapatanLabels = {!! json_encode($pendapatanMingguan->pluck('tanggal')) !!};
        const pendapatanData = {!! json_encode($pendapatanMingguan->pluck('total')) !!};

        /* =====================
            BOOKING BAR CHART
        ===================== */
        new Chart(document.getElementById('bookingChart'), {
            type: 'bar',
            data: {
                labels: bookingLabels.map(d =>
                    new Date(d).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'short'
                    })
                ),
                datasets: [{
                    data: bookingData,
                    backgroundColor: [
                        'rgba(13,110,253,0.85)',
                        'rgba(32,201,151,0.85)',
                        'rgba(255,193,7,0.85)',
                        'rgba(220,53,69,0.85)',
                        'rgba(102,16,242,0.85)',
                        'rgba(13,202,240,0.85)',
                        'rgba(108,117,125,0.85)'
                    ],
                    borderRadius: 12,
                    maxBarThickness: 55
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.parsed.y} booking`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        /* =====================
            PENDAPATAN BAR CHART
        ===================== */
        new Chart(document.getElementById('pendapatanChart'), {
            type: 'bar',
            data: {
                labels: pendapatanLabels.map(d =>
                    new Date(d).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'short'
                    })
                ),
                datasets: [{
                    data: pendapatanData,
                    backgroundColor: 'rgba(25,135,84,0.75)',
                    borderRadius: 12,
                    maxBarThickness: 55
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: v => 'Rp ' + v.toLocaleString('id-ID')
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
