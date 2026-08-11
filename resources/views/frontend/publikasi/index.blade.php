@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --pub-blue: #0d6efd;
            --pub-blue-dark: #0b5ed7;
            --pub-text: #1f2937;
            --pub-muted: #6b7280;
            --pub-bg: #f4f6f8;
            --pub-border: #e5e7eb;
        }

        .pub-page {
            background: var(--pub-bg);
            padding: 24px 0 60px;
        }

        /* Breadcrumb */
        .pub-breadcrumb {
            font-size: 0.9rem;
            color: var(--pub-muted);
            margin-bottom: 20px;
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

        /* Header */
        .pub-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--pub-text);
            margin-bottom: 12px;
        }

        .pub-header p {
            color: var(--pub-muted);
            font-size: 1rem;
            line-height: 1.6;
            max-width: 900px;
            margin-bottom: 28px;
        }

        /* Search bar */
        .pub-search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
        }

        .pub-search-bar input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--pub-border);
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--pub-text);
            background: #fff;
        }

        .pub-search-bar input[type="text"]:focus {
            outline: none;
            border-color: var(--pub-blue);
        }

        .pub-search-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--pub-blue);
            color: #fff;
            border: none;
            padding: 0 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .pub-search-btn:hover {
            background: var(--pub-blue-dark);
        }

        .pub-search-reset {
            display: inline-flex;
            align-items: center;
            font-size: 0.85rem;
            color: var(--pub-muted);
            text-decoration: none;
            padding: 0 4px;
        }

        .pub-search-reset:hover {
            color: var(--pub-text);
            text-decoration: underline;
        }

        /* Toolbar (count only) */
        .pub-toolbar {
            margin-bottom: 20px;
        }

        .pub-count {
            color: var(--pub-muted);
            font-size: 0.9rem;
        }

        .pub-count strong {
            color: var(--pub-text);
        }

        /* List */
        .pub-list-item {
            display: flex;
            gap: 20px;
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            text-decoration: none;
            color: inherit;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .pub-list-item:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
            color: inherit;
        }

        .pub-list-item .thumb {
            flex: 0 0 140px;
            height: 180px;
            border-radius: 6px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .pub-list-item .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pub-list-item .info {
            flex: 1;
            min-width: 0;
        }

        .pub-date {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: var(--pub-muted);
            margin-bottom: 8px;
        }

        .pub-item-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--pub-blue);
            margin-bottom: 8px;
        }

        .pub-item-desc {
            font-size: 0.92rem;
            color: #374151;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .no-publikasi-text {
            color: var(--pub-muted);
            padding: 30px;
            text-align: center;
            background: #fff;
            border-radius: 10px;
            border: 1px solid var(--pub-border);
        }

        @media (max-width: 576px) {
            .pub-search-bar {
                flex-direction: column;
            }

            .pub-search-btn {
                padding: 12px;
                justify-content: center;
            }

            .pub-list-item {
                flex-direction: column;
            }

            .pub-list-item .thumb {
                width: 100%;
                height: 160px;
                flex-basis: auto;
            }
        }

        .galeri-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        }

        .galeri-head .gl-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(30, 73, 116, 0.08);
            color: var(--gl-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .galeri-head h2 {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--gl-navy);
            margin: 0;
        }

        .galeri-head p {
            margin: 2px 0 0;
            color: var(--gl-muted);
            font-size: 0.9rem;
        }
    </style>
    <section class="pt-5 pb-5 mt-5">
        <div class="pub-page container">
            <!-- Breadcrumb -->


            <!-- Header -->

            <div class="galeri-head">
                <span class="gl-icon"><i class="bi bi-file-earmark-text"></i></span>
                <div>
                    <h2>Publikasi</h2>
                    <p>Kumpulan publikasi yang disusun berdasarkan hasil kegiatan dan data yang dikelola oleh Kelurahan
                        Puruk
                        Cahu Seberang</p>
                </div>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('frontend.publikasi') }}" method="GET" class="pub-search-bar" id="pubSearchForm">
                <input type="text" name="q" id="pubSearchInput" placeholder="Cari judul atau isi publikasi..."
                    value="{{ $keyword }}">
                <button type="submit" class="pub-search-btn">
                    <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
            </form>
            @if ($keyword)
                <div class="mb-4">
                    <a href="{{ route('publikasi.index') }}" class="pub-search-reset">&times; Hapus pencarian
                        "{{ $keyword }}"</a>
                </div>
            @endif

            <!-- Toolbar -->
            <div class="pub-toolbar">
                <div class="pub-count">
                    @if ($publikasi->total() > 0)
                        Menampilkan <strong>{{ $publikasi->firstItem() }}-{{ $publikasi->lastItem() }}</strong> dari
                        <strong>{{ number_format($publikasi->total(), 0, ',', '.') }}</strong> Publikasi
                    @else
                        Tidak ada publikasi ditemukan
                    @endif
                </div>
            </div>

            <!-- List Publikasi -->
            @forelse ($publikasi as $item)

                <a href="{{ route('publikasi.detail', $item->slug) }}" class="pub-list-item">
                    <div class="thumb">
                        <img src="{{ asset('storage/publikasi/' . $item->foto) }}" alt="{{ e($item->judul) }}"
                            onerror="this.onerror=null;this.src='{{ asset('image/default-carousel.jpg') }}';">
                    </div>
                    <div class="info">
                        <div class="pub-date">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            {{ $item->created_at->translatedFormat('d F Y') }}
                        </div>
                        <div class="pub-item-title">{{ $item->judul }}</div>
                        <div class="pub-item-desc">{{ Str::limit(strip_tags($item->deskripsi), 240) }}</div>
                    </div>
                </a>
            @empty
                <p class="no-publikasi-text">Tidak ada Data Publikasi untuk ditampilkan</p>
            @endforelse

            <div class="mt-4">
                {{ $publikasi->links() }}
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('pubSearchForm');
            const input = document.getElementById('pubSearchInput');
            let debounceTimer;

            input.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    form.submit();
                }, 500); // tunggu 500ms setelah user berhenti mengetik
            });
        });
    </script>
@endsection