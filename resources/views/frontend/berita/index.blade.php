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

        .galeri-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .album-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .album-card:hover {
            transform: translateY(-5px);
        }

        .album-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .album-body {
            padding: 16px;
        }

        .album-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }

        .album-desc {
            font-size: 0.9rem;
            color: #444;
        }

        .album-date {
            font-size: 0.85rem;
            color: #888;
            margin-top: 6px;
        }
    </style>

    <div class="tentang-title-bg">Berita Murung Raya</div>
    <h1>Berita Terbaru Murung Raya</h1>

    <!-- SECTION 1: 4 berita pertama -->
    <div class="galeri-container container">
        <div class="album-grid">
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
    <section class="galeri-container container">
            <div class="album-grid">
                @forelse ($beritas as $item)
                    <div class="album-card">
                        <img src="{{ $item->foto ? asset('storage/berita/' . $item->foto) : 'https://via.placeholder.com/600x300?text=No+Image' }}"
                            alt="Foto {{ $item->judul }}">

                        <div class="album-body">
                            <div class="album-title">{{ $item->judul }}</div>
                            <div class="album-desc">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                            </div>
                            <div class="album-date">
                                Oleh: {{ $item->penulis }} | {{ $item->created_at->format('d M Y') }}
                            </div>
                            <div style="margin-top: 10px;">
                                <a href="{{ route('berita.read', $item->id) }}"
                                    class="btn btn-sm btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-danger">Tidak ada pengumuman tersedia.</p>
                @endforelse
            </div>
        </section>
@endsection

