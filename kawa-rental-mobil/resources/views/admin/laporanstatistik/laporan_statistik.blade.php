@extends('admin.layout')

@section('title', 'Laporan & Statistik Bulanan')

@section('content_header')
    <h1>Laporan & Statistik Bulanan</h1>
@stop

@section('content')

<div class="row">

    <!-- Card Pendapatan -->
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Pendapatan Bulan Ini</h5>
                <h3 class="mt-3">Rp. {{ number_format($pendapatan,0,',','.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Card Jumlah Transaksi -->
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Jumlah Transaksi Bulan Ini</h5>
                <h3 class="mt-3">{{ $jumlah_transaksi }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">

    <!-- Line Chart -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Grafik Penyewaan Mobil (Tahunan)</h5>
            </div>
            <div class="card-body">
                <canvas id="lineChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Persentase Jenis Mobil Disewa</h5>
            </div>
            <div class="card-body">
                <canvas id="pieChart" height="200"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="card mt-4">
    <div class="card-header">
        <h5>Tabel Laporan & Statistik Rental Mobil Bulanan</h5>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>Status Mobil</th>
                    <th>Jumlah Unit Disewa</th>
                    <th>Jumlah Transaksi</th>
                    <th>Total Hari Sewa</th>
                    <th>Rata-rata Lama Sewa (hari)</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $row)
                <tr>
                    <td>{{ $row['jenis'] }}</td>
                    <td>{{ $row['unit'] }}</td>
                    <td>{{ $row['transaksi'] }}</td>
                    <td>{{ $row['hari'] }}</td>
                    <td>{{ $row['rata'] }}</td>
                    <td>Rp. {{ number_format($row['pendapatan'],0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    /* ========================
        LINE CHART
    ========================= */
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bulan_list) !!},
            datasets: [
                {
                    label: 'SUV',
                    borderColor: '#3b8bba',
                    data: {!! json_encode($chart_suv) !!},
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Sedan',
                    borderColor: '#00a65a',
                    data: {!! json_encode($chart_sedan) !!},
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Hybrid',
                    borderColor: '#dd4b39',
                    data: {!! json_encode($chart_hybrid) !!},
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Pickup',
                    borderColor: '#f39c12',
                    data: {!! json_encode($chart_pickup) !!},
                    fill: false,
                    tension: 0.3
                }
            ]
        }
    });

    /* ========================
        PIE CHART
    ========================= */
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['SUV', 'Sedan', 'Hybrid', 'Pickup'],
            datasets: [{
                data: {!! json_encode($pie) !!},
                backgroundColor: ['#3b8bba','#00a65a','#dd4b39','#f39c12']
            }]
        }
    });
</script>
@stop
