@extends('frontend.layout.app')

@section('content')
    <style>
        .title-bg {
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

        .galeri-container {
            padding: 60px 0;
            background: #f4f6f9;
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .album-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .album-card:hover {
            transform: translateY(-5px);
        }

        .album-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .album-body {
            padding: 16px;
        }

        .album-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }

        .album-desc {
            font-size: 0.9rem;
            color: #444;
        }

        .album-date {
            font-size: 0.85rem;
            color: #888;
            margin-top: 6px;
        }
    </style>

    @php
        $albums = [
            [
                'id' => 1,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Sosialisasi Literasi Digital',
                'desc' => 'Pengenalan literasi digital untuk pelajar dan guru.',
                'date' => '15 November 2024',
            ],
            [
                'id' => 2,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Pelatihan e-Government',
                'desc' => 'Workshop implementasi e-Gov di tingkat desa.',
                'date' => '20 November 2024',
            ],
            [
                'id' => 3,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Kunjungan Mitra Digital',
                'desc' => 'Kolaborasi antara Pemkot dan perusahaan startup.',
                'date' => '25 November 2024',
            ],
            [
                'id' => 4,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Forum Komunikasi Publik',
                'desc' => 'Diskusi antara warga dan Pemkot Surabaya.',
                'date' => '1 Desember 2024',
            ],
            [
                'id' => 5,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Bimtek Keamanan Siber',
                'desc' => 'Pelatihan dasar perlindungan data pribadi.',
                'date' => '5 Desember 2024',
            ],
            [
                'id' => 6,
                'cover' => 'galeri_foto.jpg',
                'title' => 'Seminar Inovasi Teknologi',
                'desc' => 'Pemanfaatan teknologi AI dan IoT untuk kota pintar.',
                'date' => '10 Desember 2024',
            ],
        ];
    @endphp

    <div class="title-bg">Galeri Foto</div>

    <section class="galeri-container container">
        <div class="album-grid">
            @foreach ($albums as $album)
                <a href="" class="album-card">
                    <img src="{{ asset('image/' . $album['cover']) }}" alt="Cover {{ $album['title'] }}">
                    <div class="album-body">
                        <div class="album-title">{{ $album['title'] }}</div>
                        <div class="album-desc">{{ $album['desc'] }}</div>
                        <div class="album-date">{{ $album['date'] }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
