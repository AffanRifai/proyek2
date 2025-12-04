@extends('layout.master')

@section('admin_content')
    <h2>Posisi GPS Terbaru</h2>

    @if ($location)
        <p>Latitude: {{ $location->latitude }}</p>
        <p>Longitude: {{ $location->longitude }}</p>

        <iframe width="100%" height="400"
            src="https://maps.google.com/maps?q={{ $location->latitude }},{{ $location->longitude }}&z=15&output=embed">
        </iframe>
    @else
        <p>Belum ada data GPS.</p>
    @endif
@endsection
