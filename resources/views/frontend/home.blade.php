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
            margin-top: -88px;
            padding-top: 180px;
            padding-bottom: 120px;
            position: relative;
            margin-top: -88px;
            padding-top: 180px;
            padding-bottom: 120px;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            text-align: left;
        }

        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .full-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 0;
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
            padding: 60px 5vw 100px;
            width: 100%;
            text-align: center;
        }

        .layanan-fullscreen h2 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 60px;
            color: #003366;
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
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

        .layanan-overlay svg {
            width: 45px;
            height: 45px;
            fill: #ffffff;
            background-color: #00509e;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 80, 158, 0.3);
            margin-bottom: 15px;
            transition: transform 0.4s ease;
        }

        .layanan-box:hover .layanan-overlay svg {
            transform: rotate(-10deg) scale(1.05);
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
            width: 100%;
            padding: 60px 5vw 10px;

        }

        .bidang-fullwidth h2 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 40px;
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
            flex: 1.5;
            min-width: 420px;
        }

        .bidang-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 12px;
            transform: scale(1.1);
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
        }

        .bidang-content ol li {
            font-size: 1.03rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 0.3em;
        }

        .bidang-content ol {
            margin-top: 0;
            padding-left: 20px;
        }

        /*.official-portal-section-alt {
                                                                        width: 100%;
                                                                        background: linear-gradient(100deg, #1064ca, #fdfcfb);
                                                                        padding: 20px 5vw;
                                                                        position: relative;
                                                                    }

                                                                    .logo-img {
                                                                        height: 160px;
                                                                        object-fit: contain;
                                                                        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
                                                                    }

                                                                    .official-heading h2 {
                                                                        font-size: 2.6rem;
                                                                        color: #003366;
                                                                        font-weight: 700;
                                                                        margin: 0;
                                                                        line-height: 1.4;
                                                                        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                                                                    }

                                                                    .official-btn-alt {
                                                                        display: inline-flex;
                                                                        align-items: center;
                                                                        gap: 10px;
                                                                        padding: 12px 28px;
                                                                        font-size: 1rem;
                                                                        color: #fff;
                                                                        background: linear-gradient(135deg, #003366, #0056a3);
                                                                        border-radius: 10px;
                                                                        text-decoration: none;
                                                                        font-weight: 600;
                                                                        box-shadow: 0 6px 14px rgba(0, 51, 102, 0.3);
                                                                        transition: all 0.3s ease;
                                                                    }

                                                                    .official-btn-alt:hover {
                                                                        background: linear-gradient(135deg, #002244, #004080);
                                                                        box-shadow: 0 8px 18px rgba(0, 51, 102, 0.4);
                                                                    }*/

        .galeri-home-section {

            padding: 80px 5vw;
            text-align: center;
            position: relative;
        }

        .galeri-home-section h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 60px;
            color: #003366;
            letter-spacing: 1px;
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

        .fade-image {
            transition: opacity 1s ease-in-out;
            opacity: 1;
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            /* jika jadi background */
        }
    </style>

    <div class="full-bg">
        @if (isset($carousel[0]) && $carousel[0]->foto)
            <img id="carouselImage" class="bg-video fade-image" src="{{ asset('storage/carousel/' . $carousel[0]->foto) }}"
                alt="Carousel Image">
        @else
            {{-- Gambar fallback/default jika tidak ada data --}}
            <img id="carouselImage" class="bg-video fade-image" src="{{ asset('image/default-carousel.jpg') }}"
                alt="Default Carousel Image">
        @endif

        <div class="hero-container" data-aos="fade-down">
            <h1>Selamat Datang Di Profil Diskominfo Kabupaten Murung Raya</h1>
            <p data-aos="fade-up" data-aos-delay="200">Murung Raya Hebat</p>
        </div>
    </div>

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
                                class="img-fluid rounded-circle mb-2" style="width: 60px; height: 60px; object-fit: cover;">
                            <h5>{{ $item->nama_layanan }}</h5>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted mt-4" data-aos="fade-up" data-aos-delay="200">
                <p>Tidak ada data layanan yang tersedia saat ini.</p>
            </div>
        @endif
    </section>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                        <img src="{{ asset('storage/profilbidang/' . $bidang->foto) }}" alt="{{ $bidang->nama_bidang }}"
                            style="height:300px; width:auto; object-fit:contain; display:block; margin:0 auto;">
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-muted mt-4" data-aos="fade-up">
                <p>Belum ada data bidang yang tersedia.</p>
            </div>
        @endif
    </section>
    <!-- <section class="official-portal-section-alt">
                                                                    <div class="row align-items-center justify-content-center" style="padding: 0 5vw;">
                                                                        <div class="col-lg-3 col-md-3 text-center">
                                                                            <img src="{{ asset('images/logo-murung-raya.png') }}" alt="Logo Murung Raya" class="logo-img">
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 text-center">
                                                                            <div class="official-heading">
                                                                                <h2><strong>Pemerintah Kabupaten Murung Raya</strong></h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-3 text-center">
                                                                            <a href="https://murungrayakab.go.id" target="_blank" class="official-btn-alt">
                                                                                Kunjungi
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="16" viewBox="0 0 34.53 16">
                                                                                    <rect class="line" y="7.6" width="34" height="0.4" fill="currentColor" />
                                                                                    <path class="arrow" d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z" fill="currentColor" />
                                                                                </svg>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </section> -->
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
                    <p>Pengumuman resmi dan pemberitahuan dari Diskominfo.</p>
                </div>
            </a>

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
        document.addEventListener('DOMContentLoaded', function() {
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
