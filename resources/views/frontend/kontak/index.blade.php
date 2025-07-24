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

        }

        .hero-text {
            flex: 0.7;
            padding: 50px;
            min-width: 300px;
            margin-top: auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: 100%;
            padding-left: 250px;
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
            margin-top: 60px;
            transform: translateX(-60px);
        }

        .hero-img-wrapper img {
            display: block;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            transform: translateY(80px);
            position: relative;
        }

        .hero-section {
            padding-bottom: 40px;
            position: relative;
        }

        .contact-grid-section {
            background-color: var(--gray-bg);
            padding: 50px 20px;
            position: relative;
            overflow: hidden;
        }

        .orange-half-shape {
            position: absolute;
            top: 0;
            left: 35px;
            width: 300px;
            height: 300px;
            background-color: var(--orange);
            border-bottom-left-radius: 100%;
            border-bottom-right-radius: 100%;
            transform: translateY(150%);
            z-index: 1;
        }

        .contact-card-grid {
            position: relative;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            max-width: 1000px;
            margin: 0 auto;
            align-items: stretch;
        }

        .contact-card {
            position: relative;
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
            z-index: 2;
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
    <div class="orange-half-shape"></div>
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
                <div>
                    @if ($kontak && $kontak->telepon)
                        <a href="tel:{{ $kontak->telepon }}">{{ $kontak->telepon }}</a>
                    @else
                        <span class="text-muted">Belum tersedia</span>
                    @endif
                </div>
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
                <p>
                    {{ $kontak && $kontak->lokasi ? $kontak->lokasi : 'Alamat belum tersedia' }}
                </p>
                <div>
                    @if ($kontak && $kontak->linkmaps)
                        <a href="{{ $kontak->linkmaps }}" target="_blank">Lihat di Google Maps</a>
                    @else
                        <span class="text-muted">Link belum tersedia</span>
                    @endif
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
                <p>
                    {{ $kontak && $kontak->email ? $kontak->email : 'Email belum tersedia' }}
                </p>
                <div>
                    @if ($kontak && $kontak->email)
                        <a href="mailto:{{ $kontak->email }}">Kirim Pesan di Gmail</a>
                    @else
                        <span class="text-muted">Belum ada email</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
