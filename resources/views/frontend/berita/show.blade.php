@extends('frontend.layout.app')

@section('content')
    <style>
        .tentang-title-bg {
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

        .tentang-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .tentang-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
        }
    </style>

    <div class="tentang-title-bg">Berita</div>

    <section class="tentang-container container">

            @isset($beritas)
                <h3>{{ $beritas->judul }}</h3>
                <img src="{{ asset('storage/berita/'.$beritas->foto) }}" alt="Gambar" style="width: 600px">
            @else
                <em>belum tersedia.</em>
            @endisset

    </section>
@endsection
