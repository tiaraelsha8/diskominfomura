@extends('frontend.layout.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <style>
        html {
            font-size: 16px;
        }

        body {
            overflow-x: hidden;
        }

        .full-bg {
            margin-top: 0;
            padding-top: 80px;
            padding-bottom: 80px;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            text-align: left;
        }

        .fade-image {
            transition: opacity 1s ease-in-out;
            opacity: 1;
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-container {
            position: relative;
            background: linear-gradient(135deg, rgba(0, 50, 100, 0.6), rgba(0, 0, 0, 0.3));
            padding: 30px 20px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 1;
            max-width: 600px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            margin-left: 5vw;
            margin-top: 20vw;
        }

        .hero-container h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
        }

        .hero-container p {
            font-size: 1.1rem;
            margin-top: 15px;
            color: #f0f0f0;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        }

        footer {
            margin-top: 0 !important;
        }

        .layanan-fullscreen {
            min-height: 80vh;
            margin-top: 90px;
            width: 100%;
            text-align: center;
        }

        .layanan-fullscreen h2 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 50px;
            color: #003366;
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            row-gap: 55px;
            max-width: 100%;
            padding: 0 5vw;
            margin: 0 auto;
            align-items: stretch;
        }

        .layanan-box {
            position: relative;
            width: 100%;
            height: 300px;
            border-radius: 20px;
            overflow: visible;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.4s ease;
            max-width: 350px;
            margin: 0 auto;
        }

        .layanan-bg-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            border-radius: 20px;
            overflow: hidden;
            pointer-events: none;
        }

        .layanan-bg-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s ease;
            display: block;
        }

        .layanan-box:hover .layanan-bg-wrapper img {
            transform: scale(1.3);
        }

        .layanan-overlay {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translate(-50%, 0);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(1, 43, 85, 0.575));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            width: 90%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            transition: bottom 0.4s ease, transform 0.3s ease;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            min-height: 120px;
            height: 125px;
            padding: 15px;
        }

        .layanan-box:hover .layanan-overlay {
            bottom: -30px;
            transform: translateX(-50%) scale(1.03);
        }

        .layanan-overlay img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            transition: transform 1s ease;
        }

        .layanan-box:hover .layanan-overlay img {
            transform: rotate(-15deg) scale(1.05);
        }

        .layanan-overlay h5 {
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        .bidang-fullwidth {
            min-height: 80vh;
            margin-top: 60px;
            width: 100%;
            /* text-align: center; */
        }

        .bidang-fullwidth h2 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 55px;
            color: #003366;
            text-align: center;
        }

        .bidang-row {
            max-width: 1200px;
            margin: 0 auto 50px auto;
            padding: 10px 3vw 5px 3vw;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            flex-wrap: wrap;
        }

        .bidang-row.reverse {
            flex-direction: row-reverse;
        }

        .bidang-image {
            flex: 1.6;
            height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bidang-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            display: block;
            border-radius: 12px;
            transform: scale(1.10);
            transition: transform 0.5s ease;
        }

        .bidang-image img:hover {
            transform: scale(1.05);
        }

        .bidang-content {
            flex: 1.1;
            min-width: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .bidang-content h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: #003366;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bidang-content p {
            font-size: 1.03rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 0.3em;
            text-align: justify;
        }

        .galeri-home-section {
            min-height: 80vh;
            margin-top: 80px;
            width: 100%;
            text-align: center;
        }

        .galeri-home-section h2 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 50px;
            color: #003366;
            text-align: center;
        }

        .galeri-home-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .galeri-card {
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            will-change: transform, box-shadow;
            cursor: pointer;
            transform-origin: center center;
        }

        .galeri-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 18px;
            background: rgba(0, 136, 255, 0.12);
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 0;
        }

        .galeri-card:hover {
            transform: translateY(-8px) scale(1.035);
            box-shadow: 0 12px 32px rgba(0, 136, 255, 0.25);
            z-index: 5;
        }

        .galeri-card:hover::before {
            opacity: 1;
            transform: scale(1.02);
        }

        .galeri-card>* {
            position: relative;
            z-index: 2;
        }

        .galeri-card-img {
            height: 200px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .galeri-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .galeri-card:hover .galeri-card-img img {
            transform: scale(1.05);
        }

        .galeri-card-body {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #eee;
            text-align: center;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 140px;
        }

        .galeri-card:hover .galeri-card-body {
            transform: scale(1.05);
        }

        .galeri-card-body h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 6px;
            text-transform: uppercase;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .galeri-card-body p {
            font-size: 0.95rem;
            color: #333;
            margin: 0;
            line-height: 1.4;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .galeri-card:hover .galeri-card-body h3,
        .galeri-card:hover .galeri-card-body p {
            transform: scale(1.05);
            text-shadow:
                0 0 4px rgba(0, 136, 255, 0.3),
                0 0 8px rgba(0, 136, 255, 0.2),
                0 0 12px rgba(0, 136, 255, 0.1);
            transition: transform 0.3s ease, text-shadow 0.4s ease;
        }

        .galeri-container {
            padding: 60px 0;
        }

        .fade-image {
            transition: opacity 1s ease-in-out;
            opacity: 1;
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .album-home-section {
            margin-bottom: 50px;
            margin-top: 90px;
            padding: 0 20px;
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .album-home-section .row {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .album-home-section .col {
            flex: 1 1 48%;
            min-width: 320px;
        }

        .album-home-section h2 {
            font-size: 2.4rem;
            font-weight: 700;
            color: #003366;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 50px;
        }

        .album-home-section-mura {
            margin-bottom: 50px;
            padding: 0 20px;
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .album-home-section-mura .row {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .album-home-section-mura .col {
            flex: 1 1 48%;
            min-width: 320px;
        }

        .album-home-section-mura h2 {
            font-size: 2.4rem;
            font-weight: 700;
            color: #003366;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 50px;
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .album-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .album-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .album-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
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
            color: #555;
            line-height: 1.4;
        }

        .album-date {
            font-size: 0.8rem;
            color: #777;
            margin-top: 8px;
            display: block;
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

        @media (max-width: 768px) {

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            html,
            body {
                overflow-x: hidden;
            }

            .full-bg {
                margin-top: 0;
                padding-top: 80px;
                padding-bottom: 80px;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                text-align: center;
            }

            .fade-image {
                object-position: center;
            }

            .hero-container {
                max-width: calc(100% - 10vw);
                width: 100%;
                margin: 0 5vw;
                padding: 18px 16px;
                border-radius: 14px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.32);
            }

            .hero-container h1 {
                font-size: 1.6rem;
                line-height: 1.15;
                text-align: center;
            }

            .hero-container p {
                font-size: 1rem;
                margin-top: 10px;
                text-align: center;
            }

            .layanan-fullscreen {
                margin-top: 50px;
                padding-bottom: 20px;
            }

            .layanan-fullscreen h2 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            .layanan-grid {
                grid-template-columns: 1fr;
                gap: 28px;
                padding: 0 4vw;
            }

            .layanan-box {
                height: 220px;
                max-width: 100%;
                margin: 10px auto;
                border-radius: 14px;
                overflow: visible;
            }

            .layanan-bg-wrapper img {
                transition: none;
                transform: none;
            }

            .layanan-box:hover .layanan-bg-wrapper img {
                transform: none;
            }

            .layanan-overlay {
                bottom: -25px;
                width: 94%;
                min-height: 100px;
                height: auto;
                padding: 12px;
                border-radius: 12px;
            }

            .layanan-overlay img {
                width: 48px;
                height: 48px;
            }

            .layanan-overlay h5 {
                font-size: 0.95rem;
            }

            .bidang-fullwidth {
                margin-top: 50px;
                padding-bottom: 20px;
            }

            .bidang-fullwidth h2 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            .bidang-row {
                flex-direction: column;
                gap: 18px;
                padding: 0 4vw;
                margin-bottom: 30px;
            }

            .bidang-image {
                height: 240px;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .bidang-image img {
                max-height: 100%;
                width: 100%;
                object-fit: cover;
                border-radius: 10px;
                transform: none;
            }

            .bidang-content {
                flex: auto;
                min-width: auto;
                width: 100%;
                padding: 0;
            }

            .bidang-content h3 {
                font-size: 1.5rem;
                text-align: center;
            }

            .bidang-content p {
                font-size: 1rem;
                line-height: 1.6;
                text-align: justify;
            }

            .galeri-home-section {
                margin-top: 5px;
                padding-bottom: 20px;
            }

            .galeri-home-section h2 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            .galeri-home-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 14px;
                padding: 0 4vw;
            }

            .galeri-card {
                border-radius: 12px;
            }

            .galeri-card::before {
                display: none;
            }

            .galeri-card:hover {
                transform: none;
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            }

            .galeri-card-img {
                height: 140px;
            }

            .galeri-card-img img {
                height: 100%;
                object-fit: cover;
            }

            .galeri-card-body {
                padding: 14px;
                height: auto;
                min-height: 100px;
            }

            .galeri-card-body h3 {
                font-size: 1rem;
            }

            .galeri-card-body p {
                font-size: 0.95rem;
                line-height: 1.4;
            }

            .album-home-section {
                margin-bottom: 30px;
                margin-top: 10px;
                padding: 0 15px;
                max-width: 100%;
                text-align: center;
            }

            .album-home-section .row {
                display: block;
                gap: 0;
            }

            .album-home-section .col {
                flex: none;
                width: 100%;
                min-width: auto;
                margin-bottom: 30px;
            }

            .album-home-section h2 {
                font-size: 1.6rem;
                font-weight: 700;
                margin-top: 30px;
                margin-bottom: 20px;
                color: #003366;
                text-align: center;
            }

            .album-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .album-card {
                border-radius: 10px;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .album-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
            }

            .album-card img {
                width: 100%;
                height: 160px;
                object-fit: cover;
                display: block;
            }

            .album-body {
                padding: 12px;
                text-align: left;
            }

            .album-title {
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 4px;
                color: #222;
            }

            .album-desc {
                font-size: 0.85rem;
                color: #555;
                line-height: 1.4;
            }

            .album-date {
                font-size: 0.75rem;
                color: #777;
                margin-top: 6px;
                display: block;
            }

            .galeri-container {
                padding: 40px 0;
            }

            .layanan-grid,
            .galeri-home-grid,
            .album-grid {
                width: 100%;
                box-sizing: border-box;
            }

            .navbar .nav-link,
            .layanan-overlay h5,
            .galeri-card {
                touch-action: manipulation;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0.05);
            }

            .layanan-box,
            .galeri-card,
            .album-card {
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            }

            img,
            video {
                max-width: 100%;
                height: auto;
                display: block;
            }
        }
    </style>

    <div class="full-bg">
        @if (isset($carousel[0]) && $carousel[0]->foto)
            <img id="carouselImage" class="fade-image" src="{{ asset('storage/carousel/' . $carousel[0]->foto) }}"
                alt="Carousel Image">
        @else
            {{-- Gambar fallback/default jika tidak ada data --}}
            <img id="carouselImage" class="bg-video fade-image" src="{{ asset('image/default-carousel.jpg') }}"
                alt="Default Carousel Image">
        @endif

        <div class="hero-container" data-aos="fade-down">
            <h1>Selamat Datang <br> Di Dinas Pengendalian Penduduk dan Keluarga Berencana<br> Kabupaten Murung Raya</h1>
            <p data-aos="fade-up" data-aos-delay="200">Murung Raya Hebat</p>
        </div>
    </div>

    <section class="album-home-section">
        <div class="row">
            <div class="col">
                <h2 data-aos="fade-up">Berita Terbaru</h2>
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
                        <p class="no-news-text">Berita belum tersedia</p>
                    @endforelse
                </div>
            </div>
            <div class="col">
                <h2 data-aos="fade-up">Pengumuman Terbaru</h2>
                <div class="album-grid">
                    @forelse ($pengumumanDB as $item)
                        <div class="album-card">
                            <img src="{{ $item->foto ? asset($item->foto) : 'https://via.placeholder.com/600x300?text=No+Image' }}"
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
                                    <a href="{{ route('pengumuman.detail', $item->id) }}"
                                        class="btn btn-sm btn-primary">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="no-news-text">Pengumuman belum tersedia</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    <section class="layanan-fullscreen" data-aos="fade-up">
        <h2 data-aos="fade-down" data-aos-delay="100">Layanan</h2>
        @if ($layanans->count())
            <div class="layanan-grid" data-aos="fade-up" data-aos-delay="200">
                @foreach ($layanans as $index => $item)
                    <a href="{{ $item->link }}" class="layanan-box" data-aos="zoom-in" target="_blank"
                        data-aos-delay="{{ 300 + 100 * $index }}">
                        <div class="layanan-bg-wrapper">

                            <img src="{{ asset('storage/layanan/background/' . $item->background) }}" alt="bg-layanan">
                        </div>
                        <div class="layanan-overlay">
                            <img src="{{ asset('storage/layanan/logo/' . $item->logo) }}" alt="{{ $item->nama_layanan }}"
                                class="img-fluid rounded-circle mb-2">
                            <h5>{{ $item->nama_layanan }}</h5>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted mt-4" data-aos="fade-up" data-aos-delay="200">
                <p class="no-news-text">Data Layanan belum tersedia</p>
            </div>
        @endif
    </section>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            AOS.init({
                duration: 1000,
                once: true,
            });
        });
    </script>

    <section class="bidang-fullwidth">
        <h2 data-aos="fade-up">Bidang</h2>
        @if ($profilbidangs->count())
            @foreach ($profilbidangs as $index => $bidang)
                <div class="bidang-row {{ $index % 2 === 1 ? 'reverse' : '' }}">
                    <div class="bidang-content">
                        <h3>{{ $bidang->nama_bidang }}</h3>
                        <p>{!! $bidang->deskripsi !!}</p>
                    </div>
                    <div class="bidang-image">
                        <img src="{{ asset('storage/profilbidang/' . $bidang->foto) }}" alt="{{ $bidang->nama_bidang }}">
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-muted mt-4" data-aos="fade-up" data-aos-delay="200">
                <p class="no-news-text">Data Bidang belum tersedia.</p>
            </div>
        @endif
    </section>

    <section class="galeri-home-section">
        <h2 data-aos="fade-up">Galeri</h2>
        <div class="galeri-home-grid">

            <a href="{{ route('frontend.galerifoto') }}" class="galeri-card" data-aos="fade-up" data-aos-delay="0">
                <div class="galeri-card-img">
                    <img src="{{ asset('image/galeri_foto.jpg') }}" alt="Galeri Foto">
                </div>
                <div class="galeri-card-body">
                    <h3>Galeri Foto</h3>
                    <p>Dokumentasi kegiatan dan aktivitas.</p>
                </div>
            </a>

            <a href="{{ route('frontend.galerivideo') }}" class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <div class="galeri-card-img">
                    <img src="{{ asset('image/galeri_video.jpg') }}" alt="Galeri Video">
                </div>
                <div class="galeri-card-body">
                    <h3>Galeri Video</h3>
                    <p>Video kegiatan, pelatihan, dan informasi publik.</p>
                </div>
            </a>

            <a href="{{ route('lihat-berita') }}" class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <div class="galeri-card-img">
                    <img src="{{ asset('image/galeri_berita.jpg') }}" alt="Berita">
                </div>
                <div class="galeri-card-body">
                    <h3>Berita</h3>
                    <p>Informasi terbaru seputar kegiatan dan perkembangan.</p>
                </div>
            </a>

            <a href="{{ route('lihat-pengumuman') }}" class="galeri-card" data-aos="fade-up" data-aos-delay="300">
                <div class="galeri-card-img">
                    <img src="{{ asset('image/galeri_pengumuman.jpg') }}" alt="Pengumuman">
                </div>
                <div class="galeri-card-body">
                    <h3>Pengumuman</h3>
                    <p>Pengumuman resmi dan pemberitahuan.</p>
                </div>
            </a>

        </div>
    </section>

    <section class="album-home-section-mura">
        <div class="row">
            <div class="col">
                <h2 data-aos="fade-up">Berita Murung Raya Terbaru</h2>
                <div class="album-grid">
                    @forelse ($beritaAPI as $item)
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
            <div class="col">
                <h2 data-aos="fade-up">Pengumuman Terbaru</h2>
                <div class="album-grid">
                    @forelse ($pengumumanAPI as $item)
                        <div class="card">
                            <a href="{{ $item['link'] }}" target="_blank">
                                <img src="{{ $item['image'] }}" alt="Gambar">
                            </a>
                            <div class="card-content">
                                <a href="{{ $item['link'] }}" target="_blank">
                                    <h3>{{ $item['title'] }}</h3>
                                </a>
                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item['excerpt']), 100, '...') }}
                                    <a href="{{ $item['link'] }}" target="_blank">Selengkapnya</a>
                                </p>
                                <small>{{ $item['date'] }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="no-news-text">Pengumuman belum tersedia.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    <!-- JS: Ganti gambar otomatis dengan efek -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = [
                @foreach ($carousel as $item)
                    "{{ asset('storage/carousel/' . $item->foto) }}",
                @endforeach
                                                                ];

            let index = 0;
            const imgElement = document.getElementById('carouselImage');

            setInterval(() => {
                // Mulai fade-out
                imgElement.style.opacity = 0;

                setTimeout(() => {
                    // Ganti gambar setelah fade-out
                    index = (index + 1) % images.length;
                    imgElement.src = images[index];
                    imgElement.style.opacity = 1; // Fade-in
                }, 500); // waktu fade-out
            }, 4000); // Setiap 4 detik
        });
    </script>
@endsection