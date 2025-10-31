@extends('frontend.layout.app')

@section('content')
    <style>
        .maklumat-title-bg {
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

        .maklumat-title-bg h1 {
            font-weight: 800;
            font-size: clamp(1.8rem, 4vw, 3rem);
            margin: 0;
            transform: translateY(80%);
        }

        .maklumat-container {
            padding: 60px 0;
        }

        .maklumat-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .maklumat-title-bg {
                min-height: 50vh;
                padding: 20px;
                justify-content: center;
                align-items: center;
            }

            .maklumat-title-bg h1 {
                font-size: 1.6rem;
                transform: translateY(40%);
                line-height: 1.3;
            }

            .maklumat-container {
                padding: 30px 15px;
            }

            .maklumat-container p {
                font-size: 1rem;
                line-height: 1.6;
            }
        }
    </style>

    <div class="maklumat-title-bg">
        <h1>Maklumat Layanan</h1>
    </div>

    <section class="maklumat-container container">
        @isset($maklumat)
            <div class="d-flex flex-column align-items-center text-center">
                <p class="text-muted">
                    {!! $maklumat->maklumat !!}
                </p>

                <!-- gambar responsif -->
                <img class="img-fluid mb-3 rounded shadow-sm" src="{{ asset('storage/maklumats/foto/' . $maklumat->foto) }}"
                    alt="Maklumat Foto">

                @isset($maklumat->video)
                    <!-- video responsif -->
                    <div class="ratio ratio-16x9 mb-3">
                        <video controls>
                            <source src="{{ asset('storage/maklumats/video/' . $maklumat->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    </div>
                @else
                    <em class="no-news-text">Video Maklumat Layanan belum tersedia</em>
                @endisset
            </div>
        @else
            <em class="no-news-text">Maklumat Layanan belum tersedia</em>
        @endisset
    </section>
@endsection
