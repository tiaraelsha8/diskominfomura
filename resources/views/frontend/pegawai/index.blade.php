@extends('frontend.layout.app')

@section('content')
    <style>
        .chart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            margin-top: 120px;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .chart-info h4 {
            margin: 0 0 8px;
            font-size: 15px;
            font-weight: 600;
            color: #000;
        }

        .chart-info ul {
            margin: 0;
            padding-left: 20px;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }

        .chart-actions button {
            background-color: #039BE5;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease;
            flex-shrink: 0;
        }

        .chart-actions button:hover {
            background-color: #0277bd;
        }

        #chart-org {
            height: 650px;
            margin-top: 10px;
        }

        .modal-dialog.modal-lg.modal-dialog-centered.custom-modal {
            max-width: 1000px;
        }

        .modal-content.rounded-4 {
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }

        .modal-body.custom-body {
            padding: 0;
        }

        .modal-body .modal-wrapper {
            position: relative;
            min-height: 500px;
        }

        .modal-bg-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 35%;
            background-color: #06385e;
            z-index: 0;
        }

        .modal-divider {
            position: absolute;
            top: 35%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }

        .modal-photo {
            position: absolute;
            top: 47%;
            left: 47px;
            transform: translateY(-50%);
            z-index: 1;
            text-align: center;
        }

        .modal-photo img {
            width: 280px;
            height: 280px;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
        }

        .modal-photo .btn {
            margin-top: 1rem;
        }

        .modal-info {
            position: absolute;
            top: 15%;
            left: 350px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .modal-info h4 {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #fff;
        }

        .modal-info p {
            margin: 0;
            font-weight: 500;
            color: #fff;
        }

        .modal-desc {
            position: absolute;
            top: 39%;
            left: 350px;
            z-index: 1;
            width: calc(100% - 370px);
            max-height: 270px;
            overflow-y: auto;
            padding-right: 10px;
            background-color: #fff;
            color: #000;
            text-align: justify;
        }

        .modal-lhkpn {
            justify-content: center;
            border-top: none;
            padding-top: 10px;
            padding-bottom: 15px;
        }

        .modal-lhkpn .btn {
            min-width: 120px;
        }

        .modal-close {
            position: absolute;
            top: 0;
            right: 0;
            margin: 1rem;
            z-index: 3;
        }

        @media (max-width: 768px) {
            .chart-actions {
                flex-direction: column-reverse;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin-top: 80px;
                padding: 0;
                text-align: center;
            }

            .chart-actions button {
                font-size: 14px;
                padding: 8px 16px;
                margin: 10px 0 12px 0;
            }

            .chart-actions h4 {
                font-size: 13px;
                line-height: 1.4;
                text-align: center;
                margin: 0;
            }

            .chart-info {
                padding: 0 16px;
            }

            .chart-info ul {
                margin: 10px 0;
                padding-left: 18px;
                font-size: 12px;
                line-height: 1.6;
                color: #444;
                text-align: justify;
            }

            #chart-org {
                height: 450px;
            }

            .modal-dialog.modal-lg.modal-dialog-centered.custom-modal {
                max-width: 95%;
                margin: auto;
            }

            .modal-body .modal-wrapper {
                position: relative;
                min-height: auto;
                padding: 15px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .modal-bg-top {
                height: 20%;
            }

            .modal-divider {
                top: 20%;
            }

            .modal-photo {
                position: relative;
                top: 30px;
                left: auto;
                transform: none;
                text-align: center;
                margin-bottom: 15px;
            }

            .modal-photo img {
                width: 180px;
                height: 180px;
            }

            .modal-info {
                position: relative;
                top: auto;
                left: auto;
                text-align: center;
                align-items: center;
                margin-bottom: 15px;
            }

            .modal-info h4 {
                margin-top: 20px;
                font-size: 1.4rem;
                color: #000;
                margin-bottom: 5px;
                line-height: 1.3;
            }

            .modal-info p {
                font-size: 0.95rem;
                color: #000;
            }

            .modal-desc {
                position: relative;
                top: auto;
                left: auto;
                width: 100%;
                overflow-y: auto;
                padding: 10px;
                background-color: #fff;
                word-break: break-word;
            }

            .modal-close {
                position: absolute;
                top: 10px;
                right: 10px;
            }
        }

        .normal-node {
            padding: 6px;
        }

        .assistant-node {
            background: #f0f8ff;
            border: 2px dashed #007bff;
            border-radius: 8px;
            font-size: 11px;
            color: #007bff;
            padding: 4px;
        }
    </style>

    <div class="w-100">
        <div class="chart-actions">
            <div class="chart-info">
                <h4>Klik tombol <b>Reset</b> untuk kembali ke tampilan awal.</h4>
                <ul>
                    <li>Untuk menggeser tampilan halaman atau struktur organisasi, gunakan fitur seret dan lepas (drag and
                        drop) dengan mouse</li>
                    <li>Untuk memperbesar atau memperkecil tampilan, gunakan roda gulir (mouse wheel).
                    </li>
                </ul>
            </div>
            {{-- <button id="resetChart">Reset</button> --}}
            <button id="toggleAll" class="btn btn-primary">Tampilkan Semua</button>
        </div>
        <div style="position: relative;">
            <div class="zoom-controls">
                <button id="zoom-in" title="Zoom In">+</button>
                <div class="zoom-level" id="zoom-level">100%</div>
                <button id="zoom-out" title="Zoom Out">−</button>
                <button id="zoom-reset" title="Reset Zoom">⟲</button>
            </div>
            <div id="chart-container"></div>
        </div>
    </div>

    <!-- Modal Detail Pegawai -->
    <div class="modal fade" id="modalTupoksi" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered custom-modal">
            <div class="modal-content rounded-4">
                <div class="modal-body custom-body">
                    <div class="modal-wrapper">
                        <div class="modal-bg-top"></div>
                        <div class="modal-divider"></div>
                        <div class="modal-photo">
                            <img id="modalImg" src="" alt="Foto">
                            <div class="modal-lhkpn">
                                <a class="btn btn-primary" href="#" id="modalLhkpnLink" target="_blank">LHKPN</a>
                            </div>
                        </div>
                        <div class="modal-info">
                            <h4 id="modalName">-</h4>
                            <p id="modalTitle">-</p>
                        </div>
                        <div class="modal-desc">
                            <p id="modalDesc">-</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white modal-close" aria-label="Close"
                            id="forceCloseBtn"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/css/jquery.orgchart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/js/jquery.orgchart.min.js"></script>

    <script>
        $(function() {
            const nodes = @json($nodes);

            // === Helper: Bangun tree dari flat data ===
            function buildTree(parentId) {
                const children = nodes.filter(n => n.parent_id === parentId);
                return children.map(child => ({
                    id: child.id,
                    name: child.name,
                    title: child.title,
                    desc: child.desc,
                    bidang: child.bidang,
                    img: child.img,
                    file_link: child.file_link,
                    is_assistant: child.is_assistant,
                    children: buildTree(child.id)
                }));
            }

            const root = nodes.find(n => n.parent_id === null);

            // Pisahkan Sekretaris dan Kepala Bidang
            const allChildren = buildTree(root.id);
            const sekretaris = allChildren.filter(n => n.is_assistant);
            const kepala_bidang = allChildren.filter(n => !n.is_assistant);

            // Buat node dummy transparan untuk menurunkan posisi Kepala Bidang
            const dummyNodeForKabid = {
                id: 'dummy-spacer',
                name: '',
                title: '',
                desc: '',
                bidang: '',
                img: '',
                file_link: '',
                is_assistant: false,
                is_dummy: true,
                children: kepala_bidang
            };

            // Struktur: Root -> [Dummy -> Kepala Bidang, Sekretaris]
            const treeData = {
                id: root.id,
                name: root.name,
                title: root.title,
                desc: root.desc,
                bidang: root.bidang,
                img: root.img,
                file_link: root.file_link,
                is_assistant: root.is_assistant,
                children: [dummyNodeForKabid, ...sekretaris]
            };

            // === Node Template ===
            function nodeTemplate(data) {
                // Node dummy dengan garis vertikal
                if (data.is_dummy) {
                    return '<div class="dummy-node"><div class="dummy-line"></div></div>';
                }

                const fileBtn = data.file_link ?
                    `<a href="${data.file_link}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">Dokumen</a>` :
                    '';
                return `
        <div class="custom-node ${data.is_assistant ? 'assistant-node' : ''}" data-id="${data.id}">
            <img src="${data.img}" alt="${data.name}" class="node-img">
            <div class="node-name">${data.name}</div>
            <div class="node-title">${data.title}</div>
            ${fileBtn}
        </div>`;
            }

            // === Inisialisasi Chart ===
            const chart = $('#chart-container').orgchart({
                'data': treeData,
                'nodeContent': 'title',
                'verticalDepth': 2,
                'pan': true,
                'zoom': true,
                'createNode': function($node, data) {
                    $node.html(nodeTemplate(data));

                    // Styling khusus untuk node dummy
                    if (data.is_dummy) {
                        $node.addClass('dummy-spacer');
                        $node.css({
                            'background': 'transparent',
                            'border': 'none',
                            'box-shadow': 'none',
                            'pointer-events': 'none'
                        });
                    }

                    // Styling khusus untuk Sekretaris
                    if (data.is_assistant) {
                        $node.css({
                            'position': 'relative',
                            'z-index': '10'
                        });
                        $node.parent().addClass('sekretaris-cell');
                    }

                    // Klik node buka modal (kecuali dummy)
                    if (!data.is_dummy) {
                        $node.on('click', function(e) {
                            e.stopPropagation();

                            $('#modalImg').attr('src', data.img ||
                                '{{ asset('volt/assets/img/user.png') }}');
                            $('#modalName').text(data.name || '-');
                            $('#modalTitle').text(data.title || '-');
                            $('#modalDesc').text(data.desc || '-');

                            if (data.file_link) {
                                $('#modalLhkpnLink').removeClass('d-none').attr('href', data
                                    .file_link);
                            } else {
                                $('#modalLhkpnLink').addClass('d-none');
                            }

                            const modal = new bootstrap.Modal(document.getElementById(
                                'modalTupoksi'));
                            modal.show();
                        });
                    }
                }
            });

            // === Zoom Controls ===
            let currentZoom = 0.6; // Set zoom awal ke 50%
            const zoomStep = 0.1;
            const minZoom = 0.5;
            const maxZoom = 2;

            // Terapkan zoom awal
            applyZoom();

            $('#zoom-in').on('click', function() {
                if (currentZoom < maxZoom) {
                    currentZoom += zoomStep;
                    applyZoom();
                }
            });

            $('#zoom-out').on('click', function() {
                if (currentZoom > minZoom) {
                    currentZoom -= zoomStep;
                    applyZoom();
                }
            });

            $('#zoom-reset').on('click', function() {
                currentZoom = 0.6;
                applyZoom();
            });

            function applyZoom() {
                $('.orgchart').css({
                    'transform': `scale(${currentZoom})`,
                    'transform-origin': 'top center'
                });
                $('#zoom-level').text(Math.round(currentZoom * 100) + '%');
            }

            // === Pan/Drag functionality ===
            let isPanning = false;
            let startX, startY, scrollLeft, scrollTop;

            $('#chart-container').on('mousedown', function(e) {
                // Jangan aktifkan pan jika klik pada node
                if ($(e.target).closest('.custom-node').length > 0) {
                    return;
                }

                isPanning = true;
                $(this).css('cursor', 'grabbing');
                startX = e.pageX - $(this).offset().left;
                startY = e.pageY - $(this).offset().top;
                scrollLeft = $(this).scrollLeft();
                scrollTop = $(this).scrollTop();
            });

            $('#chart-container').on('mouseleave mouseup', function() {
                isPanning = false;
                $(this).css('cursor', 'grab');
            });

            $('#chart-container').on('mousemove', function(e) {
                if (!isPanning) return;
                e.preventDefault();
                const x = e.pageX - $(this).offset().left;
                const y = e.pageY - $(this).offset().top;
                const walkX = (x - startX) * 1.5;
                const walkY = (y - startY) * 1.5;
                $(this).scrollLeft(scrollLeft - walkX);
                $(this).scrollTop(scrollTop - walkY);
            });

            // === Hide semua node di bawah Kepala Bidang saat awal ===
            function hideSubtreeBeyondLevel(level) {
                $('#chart-container .orgchart tr').each(function() {
                    const depth = $(this).parents('table').length;
                    if (depth > level) {
                        $(this).hide('table');

                    }
                });
            }

            setTimeout(() => {
                hideSubtreeBeyondLevel(3); // tampilkan Kadis + Sekretaris + Kabid

                // Styling tambahan untuk posisi Sekretaris
                $('.sekretaris-cell').each(function() {
                    $(this).css({
                        'position': 'relative',
                        'vertical-align': 'top'
                    });
                });
            }, 0);

            // === Tombol toggle untuk tampilkan semua node ===
            $(document).on('click', '#toggleAll', function() {
                const hidden = $('#chart-container .orgchart tr:hidden').length > 0;
                if (hidden) {
                    $('#chart-container .orgchart tr').fadeIn(400);
                    $(this).text('Sembunyikan Struktur Detail');
                } else {
                    hideSubtreeBeyondLevel(3);
                    $('#chart-container .orgchart table table table tr.lines').hide();
                    $(this).text('Tampilkan Struktur Detail');
                }
            });
        });
    </script>

    <style>
        #chart-container {
            width: 100%;
            height: 600px;
            display: flex;
            justify-content: center;
            overflow: auto;
            background: #f5f7fa;
            border-radius: 8px;
            padding: 20px;
            position: relative;
            cursor: grab;
        }

        #chart-container:active {
            cursor: grabbing;
        }

        .orgchart {
            background: none !important;
            transition: transform 0.2s ease;
        }

        /* Zoom Controls */
        .zoom-controls {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .zoom-controls button {
            width: 40px;
            height: 40px;
            border: none;
            background: #0071b4;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.2s;
        }

        .zoom-controls button:hover {
            background: #005b94;
        }

        .zoom-controls button:active {
            transform: scale(0.95);
        }

        .zoom-level {
            text-align: center;
            font-size: 12px;
            color: #333;
            padding: 5px 0;
            font-weight: bold;
        }

        /* Tambah jarak horizontal antar node */
        .orgchart td {
            padding-left: 25px !important;
            padding-right: 25px !important;
        }

        /* Style untuk node dummy - transparan dengan garis vertikal */
        .dummy-node {
            width: 2px;
            height: 193px;
            background: transparent;
            border: none;
            padding: 0;
            margin: 0 auto;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dummy-line {
            width: 2px;
            height: 100%;
            background: #D9534F;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .dummy-spacer {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        /* Style untuk cell Sekretaris */
        .sekretaris-cell {
            position: relative;
        }

        /* Garis penghubung khusus untuk Sekretaris */
        .sekretaris-cell::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 2px;
            height: 20px;
            background: #0071b4;
            transform: translateX(-50%);
        }

        .custom-node {
            background-color: #e6f0ff;
            border: 2px solid #b5d0ff;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            width: 150px;
            min-height: 180px;
            max-height: 180px;
            height: 180px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow: hidden;
        }

        .custom-node:hover {
            transform: scale(1.05);
        }

        .node-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 8px;
            flex-shrink: 0;
        }

        .node-name {
            font-weight: bold;
            color: #004080;
            font-size: 14px;
            margin-bottom: 4px;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.2;
        }

        .node-title {
            font-size: 12px;
            color: #333;
            margin-bottom: 8px;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.2;
        }

        /* Sekretaris style khusus */
        .assistant-node {
            background-color: #0071b4;
            color: white;
            border: 2px solid #005b94;
        }

        .assistant-node .node-name,
        .assistant-node .node-title {
            color: white;
        }

        /* Atur posisi level kedua (Sekretaris + Kabid) */
        .orgchart>table>tbody>tr>td>table>tbody>tr:first-child {
            vertical-align: top;
        }

        /* Beri jarak lebih untuk Sekretaris */
        .orgchart .assistant-node {
            margin-bottom: 10px;
        }

        /* Styling untuk tombol dokumen agar tidak melebihi ukuran node */
        .custom-node .btn {
            font-size: 11px;
            padding: 4px 8px;
            margin-top: auto;
        }

        .orgchart table table table tr.lines {
            display: none;
        }
    </style>
@endpush
