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

        .video-container {
            padding: 60px 0;
        }

        .ratio {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

            .video-container {
                padding: 30px 15px;
            }

            .row.g-4 {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .row.g-4 .col-md-6 {
                max-width: 100% !important; 
            }

            .ratio {
                border-radius: 6px;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }

            .row.g-4 h5 {
                font-size: 1rem;
                margin-top: 8px;
                text-align: center;
            }

            .row.g-4 p {
                font-size: 0.85rem;
                line-height: 1.4;
                text-align: center;
            }

            .no-news-text {
                text-align: center;
                font-size: 0.9rem;
                color: #555;
            }
        }
    </style>

    <div class="title-bg"><h1>Galeri Video</h1></div>

    <section class="video-container container">
        <div class="row g-4">

            @forelse ($videos as $key => $value)
                <div class="col-md-6" style="max-width: 32%">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/{{ $value->video }}" title="Video 1" allowfullscreen></iframe>
                    </div>
                    <h5 class="mt-2">{{ $value->judul }}</h5>
                    <p>{{ $value->deskripsi }}</p>
                </div>
            @empty
                <p class="no-news-text">Tidak ada Data Galeri Video untuk ditampilkan</p>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $videos->links() }}
        </div>
    </section>
@endsection
