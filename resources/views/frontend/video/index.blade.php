@extends('frontend.layout.app')

@section('content')
    <style>
        .video-title-bg {
            margin-top: -88px;
            padding-top: 180px;
            padding-bottom: 120px;
            background: url('{{ asset('image/bg_galeri.jpg') }}') center/cover no-repeat;
            color: #ffffff;
            font-weight: 800;
            font-size: 3rem;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            letter-spacing: 1.5px;
        }

        .video-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .ratio {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="video-title-bg">Galeri Video</div>

    <section class="video-container container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/YOUTUBE_ID1" title="Video 1" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/YOUTUBE_ID2" title="Video 2" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
