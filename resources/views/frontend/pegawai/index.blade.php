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
            background: #f9f9f9;
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
            }

            .chart-actions h4 {
                font-size: 13px;
                line-height: 1.4;
                text-align: center;
                margin: 0;
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
            <button id="resetChart">Reset</button>
        </div>
        <div id="chart-org"></div>
    </div>

    <!-- Modal Detail Pegawai -->
    <div class="modal fade" id="modalTupoksi" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://balkan.app/js/OrgChart.js"></script>
    <!-- Bootstrap JS (v5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);
        OrgChart.icon.reset = function(w, h, color) {
            return '<svg fill="' + color + '" xmlns="http://www.w3.org/2000/svg" width="' + w + '" height="' + h +
                '" viewBox="0 0 24 24"><path d="M12 5V1L8 5l4 4V6c3.309 0 6 2.691 6 6 0 1.032-.259 2.004-.715 2.851l1.514 1.314C19.541 15.152 20 13.628 20 12c0-4.411-3.589-8-8-8zm-6.799.929L3.687 8.657C2.459 10.848 2 12.372 2 14c0 4.411 3.589 8 8 8v4l4-4-4-4v3c-3.309 0-6-2.691-6-6 0-1.032.259-2.004.715-2.851l1.486-1.29z"/></svg>';
        };
        $(document).ready(function() {
            const data = @json($nodes);
            // Inisialisasi chart
            let chart = new OrgChart(document.getElementById("chart-org"), {
                template: "myTemplate",
                mode: 'light',
                enableSearch: false,
                nodeMouseClick: OrgChart.action.none,
                collapse: {
                    level: 2,
                    allChildren: true,
                },
                scaleInitial: 0.9,
                align: OrgChart.ORIENTATION,
                mouseScrool: OrgChart.action.ctrlZoom,
                showXScroll: true,
                layout: OrgChart.normal,
                editForm: {
                    addMore: null,
                    generateElementsFromFields: false,
                    readOnly: true,
                    elements: [{
                            type: 'textbox',
                            label: 'Nama Lengkap',
                            binding: 'name'
                        },
                        {
                            type: 'textbox',
                            label: 'Jabatan',
                            binding: 'title'
                        },
                        {
                            type: 'textbox',
                            label: 'Bidang',
                            binding: 'bidang'
                        },
                        {
                            type: 'textbox',
                            label: 'Tupoksi',
                            binding: 'desc'
                        }
                    ]
                },
                nodeMenu: {
                    download: {
                        text: "Download File LHKPN",
                        icon: OrgChart.icon.pdf(24, 24, "#039BE5"),
                        onClick: function(args) {
                            const fileUrl = data[args - 1].file_link;
                            if (fileUrl) {
                                window.open(fileUrl, '_blank');
                            } else {
                                alert("File LHKPN tidak tersedia.");
                            }
                        }
                    }
                },
                nodeBinding: {
                    field_0: "name",
                    field_1: "title",
                    field_2: "desc",
                    field_3: "bidang",
                    field_4: "file_link",
                    img_0: "img"
                }
            });
            chart.on('click', function(sender, args) {
                const clickedNode = data.find(item => item.id === args.node.id);
                if (!clickedNode) return;
                $('#modalName').text(clickedNode.name || '-');
                $('#modalTitle').text(clickedNode.title || '-');
                $('#modalBidang').text(clickedNode.bidang || '-');
                $('#modalDesc').text(clickedNode.desc || '-');
                $('#modalImg').attr('src', clickedNode.img || '');
                if (clickedNode.file_link) {
                    $('#modalLhkpnLink')
                        .attr('href', clickedNode.file_link)
                        .text('LHKPN')
                        .show()
                        .removeClass('btn-secondary')
                        .addClass('btn-primary')
                        .css('pointer-events', 'auto');
                } else {
                    $('#modalLhkpnLink')
                        .attr('href', '#')
                        .text('Belum ada LHKPN')
                        .show()
                        .removeClass('btn-primary')
                        .addClass('btn-secondary')
                        .css('pointer-events', 'none');
                };
                $('#modalTupoksi').modal('show');
            });
            chart.searchUI.on('searchclick', function(sender, args) {
                sender.instance.center(args.nodeId, {
                    parentState: OrgChart.COLLAPSE_PARENT_NEIGHBORS,
                    childrenState: OrgChart.COLLAPSE_SUB_CHILDRENS
                });
                return false;
            });
            chart.on('expcollclick', function(sender, collapse, id) {
                if (!collapse) {
                    sender.center(id, {
                        parentState: OrgChart.COLLAPSE_PARENT_NEIGHBORS,
                        childrenState: OrgChart.COLLAPSE_SUB_CHILDRENS,
                        rippleId: id
                    });
                    return false;
                }
            });
            // $('#resetChart').on('click', function() {
            //     chart.load(data);
            // });
            chart.load(data);
            // Event klik tombol reset
            document.getElementById("resetChart").addEventListener("click", function() {
                chart.load(data);
                chart.fit();
            });
            // Tombol close khusus modal
            $('#forceCloseBtn').on('click', function() {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalTupoksi'));
                modal.hide();
            });
        });

        function mobileLhkpn() {
            const modalPhoto = document.querySelector('.modal-photo');
            const modalInfo = document.querySelector('.modal-info');
            const lhkpn = modalPhoto.querySelector('.modal-lhkpn');

            // hapus clone lama jika ada
            const existingClone = modalInfo.querySelector('.modal-lhkpn-clone');
            if (existingClone) existingClone.remove();

            if (window.innerWidth < 768) {
                // sembunyikan tombol asli
                lhkpn.style.display = 'none';

                // buat clone tombol di bawah modal-info
                const clone = lhkpn.cloneNode(true);
                clone.classList.add('modal-lhkpn-clone');
                clone.style.display = 'flex';
                clone.style.justifyContent = 'center';
                clone.style.marginTop = '10px';
                modalInfo.appendChild(clone);
            } else {
                // tampilkan tombol asli di desktop
                lhkpn.style.display = 'flex';
            }
        }

        // Jalankan saat load dan resize
        window.addEventListener('load', mobileLhkpn);
        window.addEventListener('resize', mobileLhkpn);
    </script>
@endpush
