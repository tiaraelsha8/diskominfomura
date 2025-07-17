@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --blue-dark: #002d5c;
            --orange: #ff6600;
            --teal: #00c291;
            --gray-bg: #f0f2f5;
        }

        .hero-section {
            margin-top: -88px;
            padding-top: 180px;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            background-color: var(--blue-dark);
            color: white;
            padding: 10px 20px 0px;
            position: relative;
            z-index: 1;
        }

        .hero-text {
            flex: 1;
            padding: 20px;
            min-width: 300px;
            margin-top: auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 100%;
            margin-left: 40px;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 1rem;
            line-height: 1.7;
        }

        .hero-text a {
            color: var(--orange);
            text-decoration: underline;
        }

        .hero-img {
            flex: 1;
            padding: 20px;
            min-width: 300px;
        }

        .hero-img img {
            width: 100%;
            max-width: 480px;
            border-radius: 10px;
            display: block;
            margin: 0 auto;
        }

        .hero-img-wrapper {
            position: relative;
            z-index: 5;
            margin-top: 60px;
            /* geser gambar ke bawah lebih dalam */
        }

        .hero-img-wrapper img {
            display: block;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            transform: translateY(100px);
            /* semakin besar, semakin masuk ke bawah */
            position: relative;
            z-index: 5;
        }

        .hero-section {
            padding-bottom: 40px;
            /* kurangi padding bawah agar tidak terlalu besar */
            position: relative;
            z-index: 1;
        }

        .contact-grid-section {
            position: relative;
            background-color: #fff;
            /* ini putih agar kontras dengan gambar */
            z-index: 0;
        }

        .contact-grid-section {
            background-color: var(--gray-bg);
            padding: 100px 20px;
            position: relative;
            overflow: hidden;
        }

        .orange-half-shape {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: var(--orange);
            border-bottom-left-radius: 100%;
            border-bottom-right-radius: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            transform: translateY(-50%);
        }

        .contact-card-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-card {
            background-color: #fff;
            padding: 36px 28px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-4px);
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 16px;
            color: var(--blue-dark);
        }

        .contact-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 14px;
        }

        .contact-card p {
            font-size: 1rem;
            color: #444;
            line-height: 1.6;
        }

        .contact-card a {
            margin-top: 12px;
            display: inline-block;
            color: var(--teal);
            font-weight: 600;
            text-decoration: none;
        }

        .contact-card a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2.4rem;
            }

            .hero-text p {
                font-size: 1rem;
            }
        }
    </style>

    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="hero-text">
            <h1>Hubungi Kami</h1>
            <p>
                Punya pertanyaan? Anda mungkin dapat menemukan jawabannya di <a href="#">Kontak Person Diskominfo</a>.
                Jika tidak, berikut adalah berbagai cara untuk menghubungi tim kami.
            </p>
        </div>
        <div class="hero-img">
            <div class="hero-img-wrapper">
                <img src="{{ asset('image/tim.webp') }}" alt="Tim Layanan Kontak">
            </div>
        </div>

    </div>

    {{-- Kontak Card Section --}}
    <section class="contact-grid-section">
        <div class="orange-half-shape"></div>
        <div class="contact-card-grid">
            <div class="contact-card">
                <div class="card-icon">📞</div>
                <h4>Untuk Pengguna Saat Ini</h4>
                <p>Sudah menggunakan layanan kami? Tim dukungan pelanggan kami siap menjawab pertanyaan Anda.</p>
                <a href="#">Hubungi Kami →</a>
            </div>
            <div class="contact-card">
                <div class="card-icon">🆕</div>
                <h4>Layanan Baru</h4>
                <p>Ingin mendaftar layanan baru atau membutuhkan panduan awal? Tim onboarding kami akan membantu Anda.</p>
                <a href="#">Hubungi Kami →</a>
            </div>
            <div class="contact-card">
                <div class="card-icon">🏢</div>
                <h4>Untuk Mitra / Instansi</h4>
                <p>Anda perwakilan dari instansi atau mitra kerja? Kami siap menghubungkan Anda dengan tim hubungan
                    kemitraan.</p>
                <a href="#">Hubungi Kami →</a>
            </div>
        </div>
    </section>
@endsection