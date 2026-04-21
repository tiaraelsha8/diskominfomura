@extends('frontend.layout.app')

@section('content')
    <style>
        .tentang-title-bg {
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

        .tentang-title-bg h1 {
            font-weight: 800;
            font-size: clamp(1.8rem, 4vw, 3rem);
            margin: 0;
            transform: translateY(80%);
        }

        .tentang-container {
            padding: 60px 0;
        }

        .tentang-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
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
            height: 100px;
            border-radius: 20px;
            overflow: visible;
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
            background: linear-gradient(135deg, rgba(86, 152, 244, 0.83), rgba(0, 128, 255, 0.96));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            width: 90%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            transition: bottom 0.4s ease, transform 0.3s ease;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            color: #12171c;
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

        @media (max-width: 768px) {
            .tentang-title-bg {
                min-height: 50vh;
                padding: 20px;
                justify-content: center;
                align-items: center;
            }

            .tentang-title-bg h1 {
                font-size: 1.6rem;
                transform: translateY(70%);
                line-height: 1.3;
            }

            .tentang-container {
                padding: 30px 15px;
            }

            .tentang-container p {
                font-size: 1rem;
                line-height: 1.6;
            }
        }
    </style>

    <div class="tentang-title-bg">
        <h1>Hasil Pemilihan RT di Kelurahan Beriwit</h1>
    </div>

    <section class="layanan-fullscreen" data-aos="fade-up">
        <h2 data-aos="fade-down" data-aos-delay="100">Hasil Pemilihan Ketua RT</h2>
        @if ($pemilihanrts->count())
            <div class="layanan-grid" data-aos="fade-up" data-aos-delay="200">
                @foreach ($pemilihanrts as $index => $item)
                    <a href="{{ $item->link_hasil }}" class="layanan-box" data-aos="zoom-in" target="_blank"
                        data-aos-delay="{{ 300 + 100 * $index }}">
                        <div class="layanan-overlay">
                            <h5>{{ $item->nama_rt }}</h5>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted mt-4" data-aos="fade-up" data-aos-delay="200">
                <p class="no-news-text">Data Pemilihan belum tersedia</p>
            </div>
        @endif
    </section>


@endsection