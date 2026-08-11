@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --pub-blue: #0d6efd;
            --pub-blue-dark: #0b5ed7;
            --pub-title: #14355e;
            --pub-text: #1f2937;
            --pub-muted: #6b7280;
            --pub-bg: #f4f6f8;
            --pub-border: #e5e7eb;
        }

        .pub-detail-page {
            background: var(--pub-bg);
            padding: 24px 0 60px;
        }

        .pub-breadcrumb {
            font-size: 0.9rem;
            color: var(--pub-muted);
            margin-bottom: 16px;
        }

        .pub-breadcrumb a {
            color: var(--pub-blue);
            text-decoration: none;
        }

        .pub-breadcrumb a:hover {
            text-decoration: underline;
        }

        .pub-breadcrumb .sep {
            margin: 0 6px;
            color: #c1c7cf;
        }

        /* Header: judul + tombol bagikan */
        .pub-page-header {
            font-weight: 800;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
        }

        .pub-page-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--pub-title);
            line-height: 1.35;
            margin: 0;
        }

        .pub-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eef1f4;
            border: none;
            color: var(--pub-text);
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s ease;
        }

        .pub-share-btn:hover {
            background: #e2e6ea;
        }

        /* Card utama */
        .pub-detail-card {
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 32px;
        }

        .pub-detail-grid {
            display: flex;
            gap: 32px;
        }

        .pub-detail-left {
            flex: 0 0 280px;
        }

        .pub-detail-cover {
            width: 100%;
            aspect-ratio: 3 / 4;
            object-fit: cover;
            border-radius: 6px;
            background: #f0f0f0;
            margin-bottom: 16px;
            display: block;
        }

        .pub-btn-primary,
        .pub-btn-outline {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 10px;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .pub-btn-primary {
            background: var(--pub-blue);
            color: #fff !important;
            border: 1px solid var(--pub-blue);
        }

        .pub-btn-primary:hover {
            background: var(--pub-blue-dark);
            color: #fff;
        }

        .pub-btn-outline {
            background: #fff;
            color: var(--pub-blue) !important;
            border: 1px solid var(--pub-blue);
        }

        .pub-btn-outline:hover {
            background: #eef5ff;
        }

        .pub-detail-right {
            flex: 1;
            min-width: 0;
        }

        .pub-abstrak-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--pub-text);
            margin: 0 0 12px;
        }

        .pub-abstrak-text {
            font-size: 0.98rem;
            color: #374151;
            line-height: 1.8;
            white-space: pre-line;
        }

        .pub-meta-note {
            font-size: 0.85rem;
            color: var(--pub-muted);
            margin-top: 20px;
        }

        /* Publikasi lainnya */
        .pub-related h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--pub-text);
            margin-bottom: 16px;
        }

        .pub-related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .pub-related-item {
            display: block;
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 10px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .pub-related-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            color: inherit;
        }

        .pub-related-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .pub-related-body {
            padding: 14px;
        }

        .pub-related-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--pub-text);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .pub-related-date {
            font-size: 0.78rem;
            color: var(--pub-muted);
        }

        @media (max-width: 700px) {
            .pub-detail-grid {
                flex-direction: column;
            }

            .pub-detail-left {
                flex: 1 1 auto;
                max-width: 280px;
                margin: 0 auto;
            }

            .pub-detail-card {
                padding: 20px;
            }

            .pub-page-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="pub-detail-page container">
        <!-- Breadcrumb -->
        <div class="pub-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span class="sep">&rsaquo;</span>
            <a href="{{ route('publikasi.index') }}">Produk - Publikasi</a>
            <span class="sep">&rsaquo;</span>
            <span>{{ Str::limit($publikasi->judul, 50) }}</span>
        </div>

        <!-- Judul + Bagikan -->
        <div class="pub-page-header">
            <h1 class="pub-page-title">{{ $publikasi->judul }}</h1>
            <button type="button" class="pub-share-btn" onclick="sharePublikasi()">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="18" cy="5" r="3" />
                    <circle cx="6" cy="12" r="3" />
                    <circle cx="18" cy="19" r="3" />
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                </svg>
                Bagikan
            </button>
        </div>

        <!-- Konten Detail -->
        <div class="pub-detail-card">
            <div class="pub-detail-grid">
                <div class="pub-detail-left">
                    <img class="pub-detail-cover" src="{{ asset('storage/publikasi/' . $publikasi->foto) }}"
                        alt="{{ e($publikasi->judul) }}"
                        onerror="this.onerror=null;this.src='{{ asset('image/default-carousel.jpg') }}';">

                    @if ($publikasi->file_path)
                        <a href="{{ route('publikasi.download', $publikasi->slug) }}" class="pub-btn-primary">
                            <svg width="16" height="16" fill="none" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" y1="15" x2="12" y2="3" />
                            </svg>
                            Unduh Publikasi
                        </a>
                    @endif
                </div>

                <div class="pub-detail-right">
                    <h1 class="pub-abstrak-title">{{ $publikasi->judul }}</h1>
                    {{-- <h2 class="pub-abstrak-title">Deskripsi</h2> --}}
                    <div class="pub-abstrak-text">{{ $publikasi->deskripsi }}</div>

                    <div class="pub-meta-note">
                        Diterbitkan {{ $publikasi->created_at->translatedFormat('d F Y') }}
                        @if ($publikasi->file_path)
                            &middot; {{ number_format($publikasi->download_count ?? 0, 0, ',', '.') }}x diunduh
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Publikasi Lainnya -->
        {{-- @if ($publikasiLainnya->isNotEmpty())
            <div class="pub-related">
                <h2>Publikasi Lainnya</h2>
                <div class="pub-related-grid">
                    @foreach ($publikasiLainnya as $related)
                        <a href="{{ route('publikasi.detail', $related->slug) }}" class="pub-related-item">
                            <img src="{{ asset('storage/publikasi/' . $related->foto) }}"
                                alt="{{ e($related->judul) }}"
                                onerror="this.onerror=null;this.src='{{ asset('image/default-carousel.jpg') }}';">
                            <div class="pub-related-body">
                                <div class="pub-related-title">{{ $related->judul }}</div>
                                <div class="pub-related-date">{{ $related->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif --}}
    </div>

    <script>
        function sharePublikasi() {
            const shareData = {
                title: @json($publikasi->judul),
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData).catch(() => {});
            } else {
                navigator.clipboard.writeText(shareData.url).then(() => {
                    alert('Link disalin ke clipboard!');
                });
            }
        }
    </script>
@endsection