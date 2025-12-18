@extends('layout.master')

@section('admin_content')

{{-- =====================
    CONTENT WRAPPER
===================== --}}
<div class="content-wrapper">

    {{-- HEADER --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                    <small class="text-muted">Ringkasan aktivitas rental</small>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                {{-- TOTAL BOOKING --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalBooking }}</h3>
                            <p>Total Booking</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>

                {{-- BOOKING PENDING --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $bookingPending }}</h3>
                            <p>Booking Pending</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-clock"></i>
                        </div>
                    </div>
                </div>

                {{-- PENDAPATAN --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rp {{ number_format($pendapatanBulanIni,0,',','.') }}</h3>
                            <p>Pendapatan Bulan Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>

                {{-- MOBIL TERSEDIA --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $mobilTersedia }}</h3>
                            <p>Mobil Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

@endsection


{{-- =====================
    RESPONSIVE FIX ICON
===================== --}}
@push('styles')
<style>
/* Rounded card biar rapi */
.small-box {
    border-radius: 12px;
}

/* Pastikan ikon muncul di mobile */
@media (max-width: 767px) {
    .small-box .icon {
        display: block !important;
        font-size: 40px;
        top: 15px;
        right: 20px;
        opacity: 0.25;
    }

    .small-box h3 {
        font-size: 26px;
    }

    .small-box p {
        font-size: 14px;
    }
}
</style>
@endpush