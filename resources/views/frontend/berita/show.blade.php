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

    <div class="tentang-title-bg">Galeri Berita</div>

    <section class="tentang-container container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mb-3">{{ $beritas->judul }}</h1>

                <div class="text-muted mb-2">
                    Oleh: {{ $beritas->penulis }} | {{ $beritas->created_at->format('d M Y') }}
                </div>

                @if ($beritas->foto)
                    <div class="text-center">
                        <img src="{{ asset('storage/berita/' . $beritas->foto) }}" alt="{{ $beritas->judul }}"
                            class="img-fluid mb-4" style="max-height: 400px; object-fit: cover;">
                    </div>
                @endif

                <div class="mb-4">
                    {!! $beritas->deskripsi !!}
                </div>

                <div class="mt-5">
                    <a href="{{ route('lihat-berita') }}" class="btn btn-secondary">← Kembali ke Berita</a>
                </div>
            </div>
        </div>
    </section>
@endsection
