@extends('frontend.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12 d-flex flex-column align-items-center">
            <button id="resetChart" class="btn btn-secondary mb-3">Reset</button>
            <div class="card w-100">
                <div class="card-body px-4 text-center">
                    <div id="chart-org" style="height: 650px;"></div>

                    <!-- Modal Detail Pegawai -->
                    <div class="modal fade" id="modalTupoksi" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
                        data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 1000px;">
                            <div class="modal-content rounded-4 overflow-hidden position-relative">
                                <div class="modal-body p-0">
                                    <div class="position-relative" style="min-height: 500px;">
                                        <!-- Background bagian atas garis -->
                                        <div
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 35%; background-color: #06385e; z-index: 0;">
                                        </div>

                                        <!-- Garis Pembagi Horizontal -->
                                        <div
                                            style="position: absolute; top: 35%; left: 0; width: 100%; height: 1px; background-color: #ccc; z-index: 0;">
                                        </div>

                                        <!-- Foto (setengah atas - setengah bawah) -->
                                        <div
                                            style="position: absolute; top:47%; left: 47px; transform: translateY(-50%); z-index: 1; text-align: center;">
                                            <img id="modalImg" src="" width="280" height="280"
                                                class="border rounded" alt="Foto">

                                            <!-- Tombol LHKPN di bawah foto -->
                                            <div class="mt-4">
                                                <a class="btn btn-primary" href="#" id="modalLhkpnLink"
                                                    target="_blank">LHKPN</a>
                                            </div>
                                        </div>
                                        <!-- Teks Nama, Jabatan, Bidang (kanan atas) -->
                                        <div class="position-absolute d-flex flex-column align-items-start"
                                            style="top: 15%; left: 350px; z-index: 1;">
                                            <h4 class="mb-2 fw-semibold text-white" id="modalName">-</h4>
                                            <p class="mb-0 fw-medium text-white" id="modalTitle">-</p>
                                            <p class="mb-0 fw-medium text-white" id="modalBidang">-</p>
                                        </div>

                                        <!-- Tupoksi scrollable -->
                                        <div class="position-absolute text-start"
                                            style="top: 39%; left: 350px; z-index: 1; width: calc(100% - 370px); max-height: 270px; overflow-y: auto; padding-right: 10px;">
                                            <p id="modalDesc" style="text-align: justify;">-</p>
                                        </div>

                                        <!-- Tombol Close -->
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3"
                                            aria-label="Close" id="forceCloseBtn">
                                        </button>

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
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://balkan.app/js/OrgChart.js"></script>
    <!-- Bootstrap JS (v5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);

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
                align: OrgChart.ORIENTATION,
                mouseScrool: OrgChart.action.ctrlZoom,
                showXScroll: true,
                layout: OrgChart.mixed,
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
                $('#modalLhkpnLink')
                    .attr('href', clickedNode.file_link || '#')
                    .prop('disabled', !clickedNode.file_link);

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

            $('#resetChart').on('click', function() {
                chart.load(data);
            });

            chart.load(data);

            // Tombol close khusus modal
            $('#forceCloseBtn').on('click', function() {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalTupoksi'));
                modal.hide();
            });
        });
    </script>
@endpush
