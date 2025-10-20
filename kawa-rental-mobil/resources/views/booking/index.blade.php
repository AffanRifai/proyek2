@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Pilih Mobil untuk Disewa</h2>
    <div class="row">
        @foreach ($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $car->gambar) }}" class="card-img-top" alt="{{ $car->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->nama }}</h5>
                        <p class="card-text">Harga sewa: <strong>Rp{{ number_format($car->harga_sewa, 0, ',', '.') }}/hari</strong></p>
                        <a href="{{ route('booking.create', $car->id) }}" class="btn btn-primary w-100">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
