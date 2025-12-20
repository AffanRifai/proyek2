@extends('layout.master')

@section('admin_content')

<div class="content-wrapper">

    {{-- ================= HEADER ================= --}}
    <section class="content-header">
        <div class="container-fluid">
            <h1>
                <i class="fas fa-map-marked-alt mr-1"></i>
                Tracking Lokasi
            </h1>
            <small class="text-muted">
                Monitoring lokasi kendaraan secara realtime
            </small>
        </div>
    </section>

    {{-- ================= CONTENT ================= --}}
    <section class="content">
        <div class="container-fluid">

            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-car mr-1"></i>
                        Live GPS Kendaraan
                    </strong>
                </div>

                <div class="card-body p-0 position-relative">

                    {{-- STATUS --}}
                    <div id="status" class="p-2 bg-light border-bottom text-sm">
                        ⏳ Menghubungkan ke MQTT...
                    </div>

                    {{-- MAP --}}
                    <div id="map"></div>

                    {{-- INFO PANEL --}}
                    <div class="info-panel">
                        <h6 class="mb-2">
                            📍 Informasi Lokasi
                        </h6>

                        <div class="info-item">
                            Status:
                            <span class="badge" id="conn">OFFLINE</span>
                        </div>

                        <div class="info-item">
                            Latitude: <b id="lat">-</b>
                        </div>

                        <div class="info-item">
                            Longitude: <b id="lon">-</b>
                        </div>

                        <div class="info-item">
                            Update: <b id="time">-</b>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

@endsection

{{-- ================= STYLES ================= --}}
@push('styles')
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>
#map {
    width: 100%;
    height: 550px;
    min-height: 550px;
}

.info-panel {
    position: absolute;
    top: 90px;
    right: 20px;
    width: 260px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    padding: 16px;
    z-index: 999;
    font-size: 13px;
}

.info-panel h6 {
    font-weight: 600;
}

.info-item {
    margin-bottom: 8px;
}

.badge {
    background: #dcfce7;
    color: #166534;
    font-weight: 600;
}
</style>
@endpush

{{-- ================= SCRIPTS ================= --}}
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
let map, marker;
let lastUpdate = 0;

// =====================
// INIT MAP LANGSUNG
// =====================
function initMap() {
    map = L.map('map', {
        zoomControl: true,
        preferCanvas: true
    }).setView([-2.5489, 118.0149], 5); // Indonesia

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap & CartoDB',
        maxZoom: 19
    }).addTo(map);

    marker = L.marker([-2.5489, 118.0149]).addTo(map);

    // FIX AdminLTE resize
    setTimeout(() => {
        map.invalidateSize(true);
    }, 300);
}

// =====================
// JALANKAN MAP SAAT LOAD
// =====================
window.addEventListener('load', function () {
    initMap();
});

// =====================
// MQTT
// =====================
const client = mqtt.connect('wss://broker.hivemq.com:8884/mqtt', {
    clientId: 'admin_tracking_' + Math.random().toString(16).substr(2, 8),
    reconnectPeriod: 3000
});

client.on('connect', function () {
    document.getElementById("status").innerHTML =
        "✅ Terhubung ke MQTT (Realtime)";
    document.getElementById("conn").innerText = "ONLINE";
    client.subscribe('kawa/gps');
});

client.on('message', function (topic, message) {

    // throttle 1.5 detik
    const now = Date.now();
    if (now - lastUpdate < 1500) return;
    lastUpdate = now;

    const data = JSON.parse(message.toString());
    const pos  = [data.lat, data.lon];

    marker.setLatLng(pos);
    map.panTo(pos, { animate: true, duration: 0.4 });

    document.getElementById("lat").innerText  = data.lat.toFixed(6);
    document.getElementById("lon").innerText  = data.lon.toFixed(6);
    document.getElementById("time").innerText =
        new Date().toLocaleTimeString();
});
</script>
@endpush
