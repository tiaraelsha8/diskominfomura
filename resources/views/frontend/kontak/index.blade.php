@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --blue-dark: #002d5c;
            --orange: #ff6600;
            --teal: #00c291;
            --gray-bg: #f0f2f5;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        }

        .hero-img-wrapper img {
            display: block;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            transform: translateY(100px);
            position: relative;
            z-index: 5;
        }

        .hero-section {
            padding-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .contact-grid-section {
            position: relative;
            background-color: #fff;
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
            align-items: stretch;
        }

        .contact-card {
            background-color: #fff;
            padding: 36px 28px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-4px);
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 16px;
            color: var(--blue-dark);
        }

        .contact-card:hover .card-icon svg {
            transform: scale(1.1);
        }

        .card-icon svg {
            display: block;
            margin: 0 auto;
            transition: transform 0.3s ease;
        }

        .contact-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--blue-dark);
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .contact-card p {
            font-size: 1rem;
            color: #444;
            line-height: 1.6;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        .contact-card a {
            margin-top: auto;
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
                Berikut adalah berbagai cara untuk menghubungi tim kami.
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
                <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65"
                        viewBox="0 0 24 24" fill="none" stroke="#002d5c" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone">
                        <path
                            d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                    </svg></div>
                <h4>Telepon</h4>
                <p>Hubungi tim kami secara langsung melalui nomor telepon resmi.</p>
                <!--<div><a href="tel:+6282151843686">+62 821-5184-3686</a></div>-->
            </div>
            <div class="contact-card">
                <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65"
                        viewBox="0 0 24 24" fill="none" stroke="#002d5c" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin">
                        <path
                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg></div>
                <h4>Lokasi Kantor</h4>
                <p>Jl. Letjen Soeprapto, Beriwit, Kec. Murung, Kab. Murung Raya, Kalimantan Tengah 73911</p>
                <div><a href="https://maps.app.goo.gl/UvWvGtYYSC6L3vhF8" target="_blank">Lihat di Google Maps</a>
                </div>
            </div>
            <div class="contact-card">
                <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65"
                        viewBox="0 0 24 24" fill="none" stroke="#002d5c" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                    </svg></div>
                <h4>Email</h4>
                <p>diskominfo.murungrayakab@gmail.com
                    diskominfo@murungrayakab.go.id</p>
                <div><a href="mailto:diskominfo@murungrayakab.go.id">Kirim Pesan di Gmail</a></div>
            </div>
        </div>
    </section>
@endsection
