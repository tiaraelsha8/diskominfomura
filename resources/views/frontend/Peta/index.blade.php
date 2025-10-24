@extends('frontend.layout.app')

@section('content')
    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .leaflet-container {
            z-index: 1;
        }

        .peta-title-bg {
            margin-top: 0;
            min-height: 70vh;
            background: url('{{ asset('image/bg_galeri.jpg') }}') center/cover no-repeat;
            color: #ffffff;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            letter-spacing: 1.5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .peta-title-bg h1 {
            font-weight: 800;
            font-size: clamp(1.8rem, 4vw, 3rem);
            margin: 0;
            transform: translateY(80%);
        }

        .peta-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .peta-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
        }

        @media (max-width: 768px) {
            #map {
                height: 300px;
                border-radius: 8px;
            }

            .peta-title-bg {
                min-height: 50vh;
                padding: 20px;
                justify-content: center;
                align-items: center;
            }

            .peta-title-bg h1 {
                font-size: 1.6rem;
                transform: translateY(25%);
                line-height: 1.3;
            }

            .peta-container {
                padding: 30px 15px;
            }

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>

    <div class="peta-title-bg">
        <h1>Peta - Kabupaten Murung Raya</h1>
    </div>
    <div class="container mt-5 mb-5">
        <div id="map"></div>
    </div>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-0.6391521, 114.5679174], 15); // Pusatkan di Murung Raya
        // Tile layer Satelit Esri (gratis)
        L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
                attribution: "© Esri, Maxar, Earthstar Geographics"
            }
        ).addTo(map);

        // Data dari controller Laravel
        var lokasi = @json($lokasi);
        // Tambahkan marker dan lingkaran jangkauan
        lokasi.forEach(function(item) {
            var marker = L.marker([item.latitude, item.longitude]).addTo(map);
            // Bind popup ke marker
            marker.bindPopup(
                "<strong>" + item.nama_lokasi + "</strong><br>" + (item.keterangan ?? '')
            );
            // Tambahkan lingkaran jangkauan WiFi (misalnya radius 100 meter)
            var circle = L.circle([item.latitude, item.longitude], {
                color: 'blue',
                fillColor: '#aaddff',
                fillOpacity: 0.3,
                radius: item.jangkauan_radius || 30 // bisa disesuaikan per titik
            }).addTo(map);
        });
    </script>
@endsection
