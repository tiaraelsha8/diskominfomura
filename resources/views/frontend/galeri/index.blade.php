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

        .galeri-container {
            padding: 60px 0;
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .album-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .album-card:hover {
            transform: translateY(-6px);
        }

        .album-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .album-body {
            padding: 16px;
        }

        .album-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 8px;
        }

        .album-desc {
            font-size: 0.95rem;
            color: #444;
            line-height: 1.5;
        }

        .album-date {
            font-size: 0.85rem;
            color: #999;
            margin-top: 8px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.85);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            max-width: 850px;
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.25s ease-in-out;
        }

        .modal-img {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: cover;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #222;
            margin-bottom: 10px;
        }

        .modal-desc {
            font-size: 1rem;
            color: #333;
            margin-bottom: 6px;
        }

        .modal-date {
            font-size: 0.85rem;
            color: #777;
        }

        .modal-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 16px;
            z-index: 10001;
        }

        .modal-actions span {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            width: 36px;
            height: 36px;
            transition: background 0.3s ease;
        }

        .modal-actions span:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-actions .modal-play:hover {
            color: #ccc;
        }

        .modal-actions .modal-zoom:hover,
        .modal-actions .modal-close:hover {
            color: #ccc;
        }

        .modal-actions svg {
            display: block;
        }

        .modal-img.zoomed {
            pointer-events: none;
            transform: scale(1.8);
            cursor: zoom-out;
            transition: transform 0.3s ease;
        }

        .modal-img {
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        .autoplay-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 0%;
            background: #003366;
            transition: width 3s linear;
            z-index: 10002;
        }

        .thumb-container {
            position: fixed;
            top: 100px;
            right: -300px;
            width: 120px;
            height: 80vh;
            background: linear-gradient(to bottom, #ffffff, #f9f9f9);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(5px);
            overflow-y: auto;
            transition: right 0.4s ease;
            z-index: 9998;
            padding: 16px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .thumb-container.show {
            right: 0;
        }

        .thumb-container img {
            width: 100%;
            eight: auto;
            border-radius: 4px;
            margin-bottom: 10px;
            cursor: pointer;
            object-fit: cover;
            transition: transform 0.2s ease;
        }

        .thumb-container img:hover {
            transform: scale(1.05);
        }

        .thumb-container::-webkit-scrollbar {
            width: 6px;
        }

        .thumb-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .thumb-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .thumb-container.show~.modal-next {
            right: 140px;
        }

        .modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            z-index: 10000;
            user-select: none;
            transition: background 0.3s ease;
            display: none;
        }

        .modal-nav:hover {
            background: rgba(85, 85, 85, 0.1);
            border-radius: 0;
        }

        .modal-prev {
            left: 20px;
            transition: opacity 0.3s ease;
        }

        .modal-next {
            right: 20px;
            transition: right 0.4s ease, opacity 0.3s ease;
            opacity: 1;
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

            .galeri-container {
                padding: 30px 15px;
            }

            .album-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .album-card img {
                height: 160px;
            }

            .modal-content {
                width: 95%;
                max-width: none;
                border-radius: 8px;
            }

            .modal-img {
                max-height: 250px;
            }

            .modal-body {
                padding: 16px;
            }

            .modal-title {
                font-size: 1rem;
            }

            .modal-desc {
                font-size: 0.85rem;
                line-height: 1.4;
            }

            .modal-date {
                font-size: 0.75rem;
            }

            .thumb-container {
                width: 90px;
                height: 60vh;
                top: 100px;
                right: -120px;
                padding: 10px;
                z-index: 10001 !important;
            }

            .thumb-container.show~.modal-next {
                right: 110px;
            }

            .thumb-container img {
                margin-bottom: 6px;
            }

            .modal-prev {
                left: -5px;
            }

            .modal-next {
                right: -5px !important;
                transition: none !important;
                z-index: 9999 !important;
            }

            .thumb-container.show~.modal-next {
                right: -5px !important;
            }

            .modal-nav {
                width: 40px;
                height: 40px;
                line-height: 40px;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="title-bg">
        <h1>Galeri Foto</h1>
    </div>
    <section class="galeri-container container">
        <div class="album-grid">
            @forelse ($arsipgaleris as $album)

                <div class="album-card">
                    <a href="{{ route('galerifoto.read', $album->id) }}">
                        <img src="{{ asset('storage/arsipgaleri/' . $album->foto) }}" alt="{{ e($album->nama_galeri) }}">
                    </a>
                    <div class="album-body">
                        <div class="album-title">{{ $album->nama_galeri }}</div>
                        <!-- <div class="album-desc">{{ $album->deskripsi }}</div> -->
                        <div class="album-date">{{ $album->created_at->format('d M Y') }}</div>
                    </div>
                </div>

            @empty
                <p class="no-news-text">Tidak ada Data Galeri Foto untuk ditampilkan</p>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $galeri->links() }}
        </div>
    </section>

    <div class="container">
        <h1>Galeri Foto</h1>

        @if($grupgaleri->count() > 0)
            <div class="row">
                @foreach($grupgaleri as $grup)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @php
                                // Ambil 1 foto terbaru dari bulan tersebut
                                $fotoTerbaru = \App\Models\Galeri::find($grup->id_terbaru);
                                // Format bulan '2024-01' menjadi 'Januari 2024'
                                $bulanIndo = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ];
                                $numBulan = \Carbon\Carbon::createFromFormat('Y-m', $grup->bulan)->format('m');
                                $tahun = \Carbon\Carbon::createFromFormat('Y-m', $grup->bulan)->format('Y');
                            @endphp

                            @if($fotoTerbaru && $fotoTerbaru->foto)
                                <img src="{{ asset('storage/galeri/' . $fotoTerbaru->foto) }}" class="card-img-top"
                                    alt="{{ $fotoTerbaru->judul }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                    style="height: 200px;">
                                    <span class="text-white">No Image</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $bulanIndo[$numBulan] }} {{ $tahun }}</h5>
                                <p class="card-text">Total Foto: <strong>{{ $grup->total }}</strong></p>

                                @if($fotoTerbaru)
                                    <p class="text-muted small">Foto terbaru: {{ $fotoTerbaru->judul }}</p>
                                @endif

                                <a href="{{ route('galeri.detail', $grup->bulan) }}" class="btn btn-primary btn-sm">
                                    Lihat Semua Foto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">Belum ada data galeri.</div>
        @endif
    </div>


@endsection