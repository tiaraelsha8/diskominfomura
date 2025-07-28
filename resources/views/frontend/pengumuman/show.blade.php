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

    <div class="tentang-title-bg">Galeri Pengumuman</div>

    <section class="tentang-container container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mb-3">{{ $pengumumanDB->judul }}</h1>

                <div class="text-muted mb-2">
                    Oleh: {{ $pengumumanDB->penulis }} | {{ $pengumumanDB->created_at->format('d M Y') }}
                </div>

                @if ($pengumumanDB->foto)
                    <div class="text-center">
                        <img src="{{ asset('storage/pengumuman/' . $pengumumanDB->foto) }}" alt="{{ $pengumumanDB->judul }}"
                            class="img-fluid mb-4" style="max-height: 400px; object-fit: cover;">
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

                <div class="mt-5">
                    <a href="{{ route('lihat-pengumuman') }}" class="btn btn-secondary">← Kembali ke Pengumuman</a>
                </div>
            </div>
        </div>
    </section>
@endsection
