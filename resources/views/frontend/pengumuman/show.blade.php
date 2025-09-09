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

        .pengumuman-container {
            padding: 50px 15px;
        }

        .pengumuman-container h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #222;
        }

        .pengumuman-container .meta-info {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        .pengumuman-container p {
            font-size: 1.05rem;
            color: #333;
            line-height: 1.7;
            text-align: justify;
        }

        .pengumuman-container img {
            max-height: 450px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-back {
            margin-top: 30px;
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

            .pengumuman-container {
                padding: 30px 15px;
            }

            .pengumuman-container h1 {
                font-size: 1.6rem;
                text-align: left;
            }

            .pengumuman-container p {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .pengumuman-container .meta-info {
                font-size: 0.8rem;
                color: #777;
                margin-bottom: 15px;
            }

            .pengumuman-container img {
                max-height: 250px !important;
                border-radius: 6px;
            }

            .btn {
                display: block;
                width: 100%;
                text-align: center;
                margin-top: 20px;
            }
        }
    </style>

    <div class="title-bg">
        <h1>Galeri Pengumuman</h1>
    </div>

    <section class="pengumuman-container container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10">
                <h1 class="mb-2">{{ $pengumumanDB->judul }}</h1>
                <div class="meta-info">
                    Oleh: {{ $pengumumanDB->penulis }} | {{ $pengumumanDB->created_at->format('d M Y') }}
                </div>

                @if ($pengumumanDB->foto)
                    <div class="text-center mb-4">
                        <img src="{{ asset($pengumumanDB->foto) }}" alt="{{ $pengumumanDB->judul }}">
                    </div>
                @endif

                <div class="mb-4">
                    {!! $pengumumanDB->deskripsi !!}
                </div>

                @if ($pengumumanDB->file)
                    <div class="mt-3">
                        <a href="{{ route('pengumuman.unduh', $pengumumanDB->id) }}" target="_blank"
                            class="btn btn-outline-primary">
                            📄 Unduh Dokumen
                        </a>
                    </div>
                @endif

                <div class="btn-back">
                    <a href="{{ route('lihat-pengumuman') }}" class="btn btn-secondary">
                        ← Kembali ke Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
