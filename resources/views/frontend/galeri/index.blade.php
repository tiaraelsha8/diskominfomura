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
                                <img src="{{ asset('storage/' . $fotoTerbaru->foto) }}" class="card-img-top"
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

    <!-- Modal -->
    <div class="modal" id="imageModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div id="thumbContainer" class="thumb-container">
            @foreach ($arsipgaleris as $album)
                <img src="{{ asset('storage/galeri/' . $album->foto) }}" alt="{{ $album->judul }}"
                    onclick="openModal({{ $album->id }})">
            @endforeach
        </div>
        <div class="modal-actions">
            <span class="modal-zoom" onclick="zoomImage()" aria-label="Perbesar">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    <line x1="11" y1="8" x2="11" y2="14" />
                    <line x1="8" y1="11" x2="14" y2="11" />
                </svg>
            </span>
            <span class="modal-play" onclick="toggleAutoplay()" aria-label="Putar Otomatis">
                <svg id="autoplayIcon" width="24" height="24" fill="none" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
            </span>
            <span class="modal-thumb" onclick="showThumbnails()" aria-label="Lihat Thumbnail">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
            </span>
            <span class="modal-close" onclick="closeModal()" aria-label="Tutup">
                <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </span>
        </div>
        <div class="modal-content">
            <div class="autoplay-progress" id="autoplayProgress"></div>
            <img id="modalImage" class="modal-img" src="" alt="Preview Gambar">
            <div class="modal-body">
                <div id="modalTitle" class="modal-title"></div>
                <div id="modalDesc" class="modal-desc"></div>
                <div id="modalDate" class="modal-date"></div>
            </div>
        </div>
        <span class="modal-nav modal-prev" onclick="navigateImage(-1)">&#10094;</span>
        <span class="modal-nav modal-next" onclick="navigateImage(1)">&#10095;</span>
    </div>
    <script>
        const albumData = @json($galeri->items());
        let currentIndex = -1;

        function openModal(id) {
            const index = albumData.findIndex(a => a.id === id);
            if (index === -1) return;
            const album = albumData[index];
            currentIndex = index;

            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');

            modalImg.onerror = null; // Reset handler agar tidak aktif saat src diubah
            modalImg.src = `{{ asset('storage/galeri/') }}/${album.foto}`;
            modalImg.alt = album.judul;

            modalImg.onerror = () => {
                console.warn("Fallback image used for modal:", album.foto);
                modalImg.onerror = null;
                modalImg.src = '{{ asset('image/default-carousel.jpg') }}';
            };

            document.getElementById('modalTitle').textContent = album.judul;
            document.getElementById('modalDesc').textContent = album.deskripsi;
            document.getElementById('modalDate').textContent = '';

            modal.style.display = 'flex';
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            modal.setAttribute('aria-hidden', 'false');

            modalImg.classList.remove('zoomed');
            toggleNavButtons(true);
        }

        function navigateImage(direction) {
            if (currentIndex === -1) return;

            currentIndex += direction;

            // Batas atas/bawah
            if (currentIndex < 0) currentIndex = albumData.length - 1;
            if (currentIndex >= albumData.length) currentIndex = 0;

            const album = albumData[currentIndex];
            openModal(album.id);
        }

        function zoomImage() {
            const img = document.getElementById('modalImage');
            img.classList.toggle('zoomed');
        }

        window.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft') navigateImage(-1);
            if (event.key === 'ArrowRight') navigateImage(1);
        });

        let autoplayInterval = null;
        let isAutoplaying = false;

        function toggleAutoplay() {
            const progressBar = document.getElementById('autoplayProgress');

            if (isAutoplaying) {
                clearInterval(autoplayInterval);
                isAutoplaying = false;
                updateAutoplayIcon();
                progressBar.style.width = '0%';
            } else {
                isAutoplaying = true;
                updateAutoplayIcon();
                triggerProgress();

                autoplayInterval = setInterval(() => {
                    navigateImage(1);
                    triggerProgress();
                }, 3000);
            }
        }

        function triggerProgress() {
            const progressBar = document.getElementById('autoplayProgress');
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            void progressBar.offsetWidth; // reflow trick
            progressBar.style.transition = 'width 3s linear';
            progressBar.style.width = '100%';
        }

        function updateAutoplayIcon() {
            const icon = document.getElementById('autoplayIcon');
            if (isAutoplaying) {
                icon.innerHTML =
                    '<rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect>';
            } else {
                icon.innerHTML = '<polygon points="5 3 19 12 5 21 5 3"></polygon>';
            }
        }

        function toggleNavButtons(show) {
            const prev = document.querySelector('.modal-prev');
            const next = document.querySelector('.modal-next');
            if (!prev || !next) return;
            const display = show ? 'block' : 'none';
            prev.style.display = display;
            next.style.display = display;
        }

        function showThumbnails() {
            const thumb = document.getElementById('thumbContainer');
            const modalNext = document.querySelector('.modal-next');

            thumb.classList.toggle('show');

            if (thumb.classList.contains('show')) {
                modalNext.style.right = '140px'; // lebar thumb + margin
            } else {
                modalNext.style.right = '20px'; // defaul
            }
        }

        // Stop autoplay saat modal ditutup
        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
            document.body.style.overflow = '';
            document.getElementById('imageModal').classList.remove('show');
            toggleNavButtons(false);
            document.getElementById('imageModal').setAttribute('aria-hidden', 'true');

            // ✅ Tutup thumbnail ketika modal ditutup
            document.getElementById('thumbContainer').classList.remove('show');
            document.querySelector('.modal-next').style.right = '20px';

            clearInterval(autoplayInterval);
            isAutoplaying = false;
            updateAutoplayIcon();

            // ✅ Reset autoplay
            clearInterval(autoplayInterval);
            isAutoplaying = false;
            updateAutoplayIcon(); // <-- reset icon ke play
            document.getElementById('autoplayProgress').style.width = '0%'; // <-- reset progress bar
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("img").forEach(function (img) {
                img.onerror = function () {
                    this.onerror = null; // mencegah infinite loop
                    this.src = "{{ asset('image/default-carousel.jpg') }}" // path ke gambar default
                };
            });
        });
    </script>
@endsection