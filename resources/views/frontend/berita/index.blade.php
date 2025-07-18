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

    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 40px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            flex: 1;
        }

        .card h3 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #0052cc;
        }

        .card p {
            font-size: 14px;
            color: #444;
            line-height: 1.4;
        }

        .card small {
            display: block;
            color: #888;
            margin-top: 10px;
            font-size: 12px;
        }

        .card a {
            text-decoration: none;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
        }
    </style>

    <div class="tentang-title-bg">Berita Murung Raya</div>
    <h1>Berita Terbaru Murung Raya</h1>

    <!-- SECTION 1: 4 berita pertama -->
    <div class="section" id="berita1">
        <div class="grid-container">
            @forelse ($berita as $item)
                <div class="card">
                    <a href="{{ $item['link'] }}" target="_blank">
                        <img src="{{ $item['image'] }}" alt="Gambar">
                    </a>
                    <div class="card-content">
                        <a href="{{ $item['link'] }}" target="_blank">
                            <h3>{{ $item['title'] }}</h3>
                        </a>
                        <p>{{ $item['excerpt'] }}</p>
                        <small>{{ $item['date'] }}</small>
                    </div>
                </div>
            @empty
                <p style="text-align:center; color:red;">Tidak ada berita tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- SECTION 2: sisanya -->
    <div class="section" id="berita2" style="margin-top: 50px;">
        <h2 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">
            Berita Lainnya
        </h2>
        <div class="grid-container">
            @forelse ($beritas as $item)
                <div class="card">
                    <a href="{{ route('berita.read', $item->id) }}" target="_blank">
                        <img src="{{ asset('storage/berita/'.$item->foto) }}" alt="Gambar">
                    </a>
                    <div class="card-content">
                        <a href="" target="_blank">
                            <h3>{{ $item->judul }}</h3>
                        </a>
                        <p>{{ $item->deskripsi }}</p>
                        
                    </div>
                </div>
            @empty
                <p style="text-align:center; color:red;">Tidak ada berita tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection

