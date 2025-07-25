@extends('frontend.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12 d-flex flex-column align-items-center">
            <button id="resetChart" class="btn btn-secondary mb-3">Reset</button>
            <div class="card w-100">
                <div class="card-body px-4 text-center">

                    <div id="chart-org" style="height: 650px;"></div>

                    <!-- Modal Detail Pegawai -->
                    <div class="modal fade" id="modalTupoksi" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Detail Pegawai</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                    <div class="d-flex gap-4">
                                        <div>
                                            <img id="modalImg" src="" width="220" height="220" class="rounded border" />
                                                <br> <br>
                                            <a class="btn btn-primary mb-3" href="#" id="modalLhkpnLink" target="_blank">LHKPN</a>
                                        </div>
                                        <div style="text-align: justify;">
                                            <p><strong>Nama:</strong> <span id="modalName"></span></p>
                                            <p><strong>Jabatan:</strong> <span id="modalTitle"></span></p>
                                            <p><strong>Bidang:</strong> <span id="modalBidang"></span></p>
                                            <p><strong>Tupoksi:</strong> <span id="modalDesc"></span></p>
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
                mouseScrool: OrgChart.action.none,
                showXScroll: true,
                editForm: {
                    addMore: null,
                    generateElementsFromFields: false,
                    readOnly: true,
                    elements: [{
                        type: 'textbox',
                        label: 'Nama Lengkap',
                        binding: 'name'
                    }, {
                        type: 'textbox',
                        label: 'Jabatan',
                        binding: 'title'
                    }, {
                        type: 'textbox',
                        label: 'Bidang',
                        binding: 'bidang'
                    }, {
                        type: 'textbox',
                        label: 'Tupoksi',
                        binding: 'desc'
                    }]
                },
                layout: OrgChart.mixed,
                mouseScrool: OrgChart.action.ctrlZoom,
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
                    field_0: "name", // Nama pegawai
                    field_1: "title", // Jabatan
                    field_2: "desc", // Tupoksi
                    field_3: "bidang",
                    field_4: "file_link", // Nama bidang
                    img_0: "img" // Foto
                }
            });
            chart.searchUI.on('searchclick', function(sender, args) {
                sender.instance.center(args.nodeId, {
                    parentState: OrgChart.COLLAPSE_PARENT_NEIGHBORS,
                    childrenState: OrgChart.COLLAPSE_SUB_CHILDRENS
                });
                return false;
            });

            chart.on('expcollclick', function(sender, collapse, id, ids) {
                if (!collapse) {
                    sender.center(id, {
                        parentState: OrgChart.COLLAPSE_PARENT_NEIGHBORS,
                        childrenState: OrgChart.COLLAPSE_SUB_CHILDRENS,
                        rippleId: id
                    });
                    return false;
                }
            });
            // Tombol reset
            $('#resetChart').on('click', function() {
                chart.load(data);
            });
            chart.load(data);

            // modal
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

        });
    </script>
@endpush
