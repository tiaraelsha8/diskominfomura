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
        <h1>Tentang Diskominfo SP</h1>
    </div>

    <section class="tentang-container container">
        <p class="text-muted">
            @isset($tentang)
                {!! $tentang->tentang !!}
            @else
                <em class="no-news-text">Profil Tentang belum tersedia</em>
            @endisset
        </p>
    </section>
@endsection
