@extends('frontend.layout.app')

@section('content')
    <style>
        .tentang-title-bg {
            margin-top: -95px;
            padding-top: 195px;
            padding-bottom: 120px;
            background: url('{{ asset('image/bg_galeri.jpg') }}') center/cover no-repeat;
            color: #ffffff;
            font-weight: 800;
            font-size: 3rem;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            letter-spacing: 1.5px;
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
    </style>

    <div class="tentang-title-bg">Maklumat Layanan Diskominfo SP</div>

    <section class="tentang-container container">
        @isset($maklumat)
        <div class="d-flex flex-column align-items-center">
            <p class="text-muted">
                {!! $maklumat->maklumat !!}
            </p>
            <img style="width: 900px" src="{{ asset('storage/maklumats/foto/' . $maklumat->foto) }}">
            @isset($maklumat->video)
            <video width="900" height="600" controls>
                <source src="{{ asset('storage/maklumats/video/' . $maklumat->video) }}" type="video/mp4">
            </video>
            @endisset
        </div>
        @else
            <em class="no-news-text">Maklumat Layanan belum tersedia</em>
        @endisset
    </section>
@endsection
