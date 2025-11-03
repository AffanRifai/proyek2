@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Form Booking Mobil: {{ $car->nama }}</h2>
    <div class="card shadow p-4">
        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">

            <div class="mb-3">
                <label>Nama Penyewa</label>
                <input type="text" name="nama_penyewa" class="form-control" value="{{ old('nama_penyewa', Auth::user()->name) }}" required>
            </div>

            <div class="mb-3">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label>Tujuan</label>
                <input type="text" name="tujuan" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="mulai_tgl" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="sel_tgl" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Upload KTP</label>
                    <input type="file" name="file_ktp" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Upload SIM</label>
                    <input type="file" name="file_sim" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Kirim Booking</button>
        </form>
    </div>
</div>
@endsection
