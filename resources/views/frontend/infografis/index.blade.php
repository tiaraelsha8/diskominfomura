@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --gl-navy: #1e4974;
            --gl-accent: #ff6600;
            --gl-ink: #2b2f33;
            --gl-muted: #667085;
            --gl-line: #e4e7ec;
        }

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
            padding: 60px 0 80px;
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

        /* ===== Grid & Kartu ===== */
        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .album-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(16, 24, 40, 0.07);
            border: 1px solid var(--gl-line);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .album-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(16, 24, 40, 0.14);
        }

        .album-media {
            position: relative;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: #eef1f4;
        }

        .album-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .album-card:hover .album-media img {
            transform: scale(1.08);
        }

        .album-media-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(11, 20, 32, 0.6);
            backdrop-filter: blur(4px);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .album-media-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(11, 20, 32, 0.55), transparent 55%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 16px;
        }

        .album-card:hover .album-media-overlay {
            opacity: 1;
        }

        .album-media-overlay .gl-peek {
            color: #fff;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.35);
            padding: 6px 14px;
            border-radius: 999px;
            backdrop-filter: blur(4px);
        }

        .album-body {
            padding: 18px 18px 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .album-title {
            font-size: 1.02rem;
            font-weight: 700;
            color: var(--gl-navy);
            margin-bottom: 8px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .album-desc {
            font-size: 0.88rem;
            color: var(--gl-ink);
            line-height: 1.55;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .album-date {
            font-size: 0.78rem;
            color: var(--gl-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 14px;
        }

        .album-footer {
            margin-top: auto;
        }

        .gl-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            justify-content: center;
            padding: 9px 16px;
            border-radius: 9px;
            background: var(--gl-navy);
            color: #fff !important;
            font-size: 0.85rem;
            font-weight: 700;
            border: none;
            text-decoration: none;
            transition: background 0.15s ease, gap 0.15s ease;
        }

        .gl-btn:hover {
            background: var(--gl-accent);
            gap: 9px;
        }

        .gl-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: var(--gl-muted);
        }

        .gl-empty i {
            font-size: 2.4rem;
            color: var(--gl-line);
            display: block;
            margin-bottom: 12px;
        }

        /* Pagination */
        .gl-pagination {
            margin-top: 36px;
            display: flex;
            justify-content: center;
        }

        .gl-pagination .page-link {
            color: var(--gl-navy);
            border-color: var(--gl-line);
        }

        .gl-pagination .page-item.active .page-link {
            background: var(--gl-navy);
            border-color: var(--gl-navy);
        }

        .gl-pagination .page-link:hover {
            color: var(--gl-accent);
        }

        /* ===== Modal / Lightbox ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: rgba(8, 15, 24, 0.9);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal.show .modal-content {
            animation: glFadeIn 0.28s ease-out;
        }

        @keyframes glFadeIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(8px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-content {
            max-width: 850px;
            width: 100%;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
        }

        .modal-img {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: cover;
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        .modal-img.zoomed {
            pointer-events: none;
            transform: scale(1.8);
            cursor: zoom-out;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--gl-navy);
            margin-bottom: 10px;
        }

        .modal-desc {
            font-size: 1rem;
            color: var(--gl-ink);
            margin-bottom: 6px;
            line-height: 1.6;
        }

        .modal-date {
            font-size: 0.85rem;
            color: var(--gl-muted);
        }

        .modal-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 12px;
            z-index: 10001;
        }

        .modal-actions span {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            border-radius: 8px;
            width: 38px;
            height: 38px;
            cursor: pointer;
            transition: background 0.25s ease, transform 0.15s ease;
        }

        .modal-actions span:hover {
            background: var(--gl-accent);
            transform: translateY(-2px);
        }

        .modal-actions svg {
            display: block;
        }

        .autoplay-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 0%;
            background: var(--gl-accent);
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
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        .thumb-container.show {
            right: 0;
        }

        .thumb-container img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            object-fit: cover;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .thumb-container img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .thumb-container::-webkit-scrollbar {
            width: 6px;
        }

        .thumb-container::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
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
            font-size: 1.1rem;
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            width: 46px;
            height: 46px;
            text-align: center;
            line-height: 46px;
            cursor: pointer;
            z-index: 10000;
            user-select: none;
            transition: background 0.25s ease, transform 0.15s ease;
            display: none;
        }

        .modal-nav:hover {
            background: var(--gl-accent);
            transform: translateY(-50%) scale(1.08);
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
                padding: 32px 15px 50px;
            }

            .galeri-head h2 {
                font-size: 1.25rem;
            }

            .album-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .album-media-overlay {
                opacity: 1;
                background: linear-gradient(to top, rgba(11, 20, 32, 0.45), transparent 60%);
            }

            .modal-content {
                width: 95%;
                max-width: none;
                border-radius: 12px;
            }

            .modal-img {
                max-height: 250px;
            }

            .modal-body {
                padding: 16px;
            }

            .modal-title {
                font-size: 1.1rem;
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
        <h1>Infografis</h1>
    </div>

    <section class="galeri-container container">
        <div class="galeri-head">
            <span class="gl-icon"><i class="bi bi-images"></i></span>
            <div>
                <h2>Infografis</h2>
                <p>Infografis Kelurahan Puruk Cahu Seberang</p>
            </div>
        </div>

        <div class="album-grid">
            @forelse ($infografis as $album)
                <div class="album-card" onclick="openModal({{ $album->id }})">
                    <div class="album-media">
                        <img src="{{ asset('storage/infografis/' . $album->foto) }}" alt="{{ e($album->judul) }}">
                        <span class="album-media-badge"><i class="bi bi-camera"></i> Foto</span>
                        <div class="album-media-overlay">
                            <span class="gl-peek"><i class="bi bi-zoom-in"></i> Lihat Detail</span>
                        </div>
                    </div>
                    <div class="album-body">
                        <div class="album-title">{{ $album->judul }}</div>
                        <div class="album-desc">{{ $album->deskripsi }}</div>
                        <div class="album-date"><i class="bi bi-calendar3"></i> {{ $album->created_at->format('d M Y') }}</div>
                        <div class="album-footer">
                            <button type="button" class="gl-btn" onclick="event.stopPropagation(); openModal({{ $album->id }})">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="gl-empty">
                    <i class="bi bi-images"></i>
                    Tidak ada data infografis untuk ditampilkan
                </div>
            @endforelse
        </div>

        <div class="gl-pagination">
            {{ $infografis->links() }}
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="imageModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div id="thumbContainer" class="thumb-container">
            @foreach ($infografis as $album)
                <img src="{{ asset('storage/infografis/' . $album->foto) }}" alt="{{ $album->judul }}"
                    onclick="openModal({{ $album->id }})">
            @endforeach
        </div>
        <div class="modal-actions">
            <span class="modal-zoom" onclick="zoomImage()" aria-label="Perbesar">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    <line x1="11" y1="8" x2="11" y2="14" />
                    <line x1="8" y1="11" x2="14" y2="11" />
                </svg>
            </span>
            <span class="modal-play" onclick="toggleAutoplay()" aria-label="Putar Otomatis">
                <svg id="autoplayIcon" width="20" height="20" fill="none" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
            </span>
            <span class="modal-thumb" onclick="showThumbnails()" aria-label="Lihat Thumbnail">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
            </span>
            <span class="modal-close" onclick="closeModal()" aria-label="Tutup">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
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
        const albumData = @json($infografis->items());
        let currentIndex = -1;

        function openModal(id) {
            const index = albumData.findIndex(a => a.id === id);
            if (index === -1) return;
            const album = albumData[index];
            currentIndex = index;

            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');

            modalImg.onerror = null; // Reset handler agar tidak aktif saat src diubah
            modalImg.src = `{{ asset('storage/infografis/') }}/${album.foto}`;
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

        window.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') navigateImage(-1);
            if (event.key === 'ArrowRight') navigateImage(1);
            if (event.key === 'Escape') closeModal();
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

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("img").forEach(function(img) {
                img.onerror = function() {
                    this.onerror = null; // mencegah infinite loop
                    this.src = "{{ asset('image/default-carousel.jpg') }}" // path ke gambar default
                };
            });
        });
    </script>
@endsection
