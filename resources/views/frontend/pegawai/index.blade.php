@extends('frontend.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12 d-flex flex-column align-items-center">
            <button id="resetChart" class="btn btn-secondary mb-3">Reset</button>
            <div class="card w-100">
                <div class="card-body px-4 text-center">

                    <div id="chart-org" style="height: 650px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://balkan.app/js/OrgChart.js"></script>

    <script>
        OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);
        $(document).ready(function() {
            const data = @json($nodes);
            let chart = new OrgChart(document.getElementById("chart-org"), {
                template: "myTemplate",
                mode: 'light',
                enableSearch: false,
                nodeMouseClick:OrgChart.action.none,
                toolbar: {
                    zoom: true,
                    fit: true,
                },
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

        });
    </script>
@endpush
