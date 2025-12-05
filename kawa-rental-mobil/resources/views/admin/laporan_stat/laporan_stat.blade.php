@extends('layout.master')

@section('title', 'Laporan & Statistik Bulanan')

@section('admin_content')

<div class="content-wrapper">

    {{-- HEADER --}}
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold text-dark">Laporan & Statistik Bulanan</h1>
                    <p class="text-muted mt-1">Analisis penyewaan & pendapatan rental mobil</p>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Laporan & Statistik</li>
                    </ol>
                </div>
            </div>

        </div>
    </div>


    {{-- MAIN --}}
    <section class="content">
        <div class="container-fluid">

            {{-- CARDS --}}
<div class="row g-3">

    <div class="col-md-4 col-sm-6">
        <div class="card stat-card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-primary bg-opacity-10 me-3">
                    <i class="fas fa-wallet text-primary"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1 fw-semibold">Pendapatan Bulan Ini</p>
                    <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($pendapatan,0,',','.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card stat-card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon bg-success bg-opacity-10 me-3">
                    <i class="fas fa-receipt text-success"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1 fw-semibold">Transaksi Bulan Ini</p>
                    <h3 class="fw-bold text-dark mb-0">{{ $jumlah_transaksi }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>


            {{-- CHARTS --}}
            <div class="row mt-4">

                <div class="col-md-7">
                    <div class="card chart-card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="fw-bold text-dark">Grafik Penyewaan Mobil (Tahunan)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" height="160"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card chart-card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="fw-bold text-dark">Persentase Penyewaan Mobil</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" height="240"></canvas>
                        </div>
                    </div>
                </div>

            </div>


            {{-- TABLE --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="fw-bold text-dark mb-0">Tabel Laporan & Statistik Rental Mobil Bulanan</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-modern table-hover text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Model Mobil</th>
                                <th>Unit Disewa</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Hari Sewa</th>
                                <th>Rata-rata Lama</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $row)
                                <tr>
                                    <td class="fw-semibold">{{ $row['jenis'] }}</td>
                                    <td>{{ $row['unit'] }}</td>
                                    <td>{{ $row['transaksi'] }}</td>
                                    <td>{{ $row['hari'] }}</td>
                                    <td>{{ $row['rata'] }} hari</td>
                                    <td class="fw-bold text-success">Rp {{ number_format($row['pendapatan'],0,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection



@section('admin_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /* ========= LINE CHART ========= */
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($bulan_list) !!},
            datasets: [
                @foreach($models as $model)
                    {
                        label: "{{ $model }}",
                        borderColor: "#" + Math.floor(Math.random()*16777215).toString(16),
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: .3,
                        fill: false,
                        data: {!! json_encode($chart[$model]) !!}
                    },
                @endforeach
            ]
        },
        options: {
            plugins:{
                legend:{ display:true }
            },
            scales:{ y:{ beginAtZero:true } }
        }
    });


    /* ========= PIE CHART ========= */
    new Chart(document.getElementById('pieChart'), {
        type:'pie',
        data:{
            labels: {!! json_encode($models) !!},
            datasets:[{
                data: {!! json_encode($pie) !!},
                borderWidth: 2,
                backgroundColor:[
                    '#3b8bba','#00a65a','#dd4b39','#f39c12','#605ca8','#39cccc','#d81b60','#001f3f','#ff851b'
                ]
            }]
        }
    });

</script>


<style>
    /* CARD MODERN */
    .stat-card{
        border-radius: 14px;
        transition: 0.2s;
    }
    .stat-card:hover{
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .stat-icon{
        width:52px;height:52px;
        border-radius:12px;
        display:flex;align-items:center;justify-content:center;
        font-size:22px;
    }

    /* CHART CARD */
    .chart-card{
        border-radius: 14px;
    }

    /* TABLE */
    .table-modern th{
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>

@endsection
