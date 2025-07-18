@extends('frontend.layout.app')

@section('content')
    <style>
        .tentang-title-bg {
            margin-top: -88px;
            padding-top: 180px;
            padding-bottom: 120px;
            background: url('{{ asset('image/bg_galeri.jpg') }}') center/cover no-repeat;
            color: #ffffff;
            font-weight: 800;
            font-size: 3rem;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            letter-spacing: 1.5px;
        }

        .tentang-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .tentang-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
        }
    </style>

    <div class="tentang-title-bg">Peta Lokasi Internet Publik - Kabupaten Murung Raya</div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <!-- CSS Custom -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 30px;
            text-align: center;
        }

        .container {
            padding: 20px 30px;
        }

        #map {
            height: 500px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 40px;
            padding-bottom: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            #map {
                height: 400px;
            }
        }
    </style>



    <div class="container">
        <div id="map"></div>
    </div>



    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-0.6391521, 114.5679174], 15); // Pusatkan di Murung Raya

        // Tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

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


