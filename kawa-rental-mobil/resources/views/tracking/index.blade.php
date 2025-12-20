@extends('layout.master')

@section('admin_content')
<div class="content-wrapper">

    {{-- HEADER --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-0">
                        <i class="fas fa-map-marked-alt mr-2"></i>
                        Tracking Lokasi
                    </h1>
                    <small class="text-muted">
                        Monitoring lokasi kendaraan secara realtime
                    </small>
                </div>
                <span class="badge badge-success px-3 py-2">
                    <i class="fas fa-satellite-dish mr-1"></i> LIVE
                </span>
            </div>
        </div>
    </section>

    {{-- CONTENT --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- INFO PANEL KIRI --}}
                <div class="col-lg-3 col-md-12 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-dark text-white">
                            <strong>
                                <i class="fas fa-info-circle mr-1"></i>
                                Informasi GPS
                            </strong>
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-4">
                                <i class="fas fa-car fa-3x text-primary"></i>
                                <h5 class="mt-2 mb-0">Kawa Rental Mobil</h5>
                                <small class="text-muted">ID: KWA-001</small>
                            </div>

                            <hr>

                            <p class="mb-1">
                                <i class="fas fa-map-pin text-danger mr-1"></i>
                                <strong>Latitude</strong><br>
                                <span id="lat" class="text-muted">-</span>
                            </p>

                            <p class="mb-1">
                                <i class="fas fa-map-pin text-danger mr-1"></i>
                                <strong>Longitude</strong><br>
                                <span id="lon" class="text-muted">-</span>
                            </p>

                            <p class="mb-1">
                                <i class="fas fa-location-arrow text-primary mr-1"></i>
                                <strong>Lokasi</strong><br>
                                <span id="address" class="text-muted">
                                    Mencari lokasi...
                                </span>
                            </p>

                            <p class="mb-1">
                                <i class="fas fa-clock text-warning mr-1"></i>
                                <strong>Update</strong><br>
                                <span id="time" class="text-muted">-</span>
                            </p>

                            <hr>

                            <span class="badge badge-success">
                                <i class="fas fa-signal mr-1"></i>
                                GPS ONLINE
                            </span>

                        </div>
                    </div>
                </div>

                {{-- MAP --}}
                <div class="col-lg-9 col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <iframe
                                src="{{ route('tracking.map') }}"
                                style="width:100%; height:600px; border:0;">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
const mqttClient = mqtt.connect('wss://broker.hivemq.com:8884/mqtt', {
    clientId: 'admin_info_' + Math.random().toString(16).substr(2, 8)
});

let lastGeoRequest = 0;

mqttClient.on('connect', function () {
    mqttClient.subscribe('kawa/gps');
});

mqttClient.on('message', function (topic, message) {
    const data = JSON.parse(message.toString());

    document.getElementById('lat').innerText = data.lat.toFixed(6);
    document.getElementById('lon').innerText = data.lon.toFixed(6);
    document.getElementById('time').innerText =
        new Date().toLocaleTimeString();

    // Batasi request geocoding (biar tidak spam)
    const now = Date.now();
    if (now - lastGeoRequest > 10000) {
        lastGeoRequest = now;
        getAddress(data.lat, data.lon);
    }
});

// Reverse Geocoding (GRATIS)
function getAddress(lat, lon) {
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('address').innerText =
                data.display_name || 'Alamat tidak ditemukan';
        })
        .catch(() => {
            document.getElementById('address').innerText =
                'Gagal mengambil lokasi';
        });
}
</script>
@endpush
