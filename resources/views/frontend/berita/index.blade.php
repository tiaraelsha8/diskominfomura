@extends('frontend.layout.app')

@section('content')
    <style>
        .title-bg {
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

        .title-bg h1 {
            font-weight: 800;
            font-size: clamp(1.8rem, 4vw, 3rem);
            margin: 0;
            transform: translateY(80%);
        }

        .galeri-container h1 {
            text-align: center;
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #003366;
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

        @media (max-width: 768px) {
            .title-bg {
                min-height: 50vh;
                padding: 20px;
                justify-content: center;
                align-items: center;
            }

            .title-bg h1 {
                font-size: 1.6rem;
                transform: translateY(70%);
                line-height: 1.3;
            }

            .galeri-container {
                padding: 30px 15px;
            }

            .galeri-container h1 {
                font-size: 1.4rem;
                margin-bottom: 20px;
            }

            .card img {
                height: 140px;
            }

            .card h3 {
                font-size: 1rem;
            }

            .card p {
                font-size: 0.85rem;
            }

            .card small {
                font-size: 0.75rem;
            }

            .album-card img {
                height: 150px;
            }

            .album-title {
                font-size: 1rem;
            }

            .album-desc {
                font-size: 0.85rem;
            }

            .album-date {
                font-size: 0.75rem;
            }
        }
    </style>

    <div class="title-bg">
        <h1>Berita Murung Raya</h1>
    </div>
    <!-- SECTION 1: 4 berita pertama -->
    <div class="galeri-container container">
        <h1>Berita Terbaru Murung Raya</h1>
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
                <p class="no-news-text">Berita belum tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- SECTION 2: sisanya -->
    <section class="galeri-container container">
        {{ $beritas->links() }}
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
                        <div class="flex gap-3 text-sm text-gray-500">
                            👁️ {{ number_format($item->views ?? 0) }} views
                        </div>
                        <div style="margin-top: 10px;">
                            <a href="{{ route('berita.read', $item->id) }}" class="btn btn-sm btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-news-text">Berita belum tersedia</p>
            @endforelse
        </div>
    </section>
@endsection
