@extends('frontend.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12 d-flex">
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
        $(document).ready(function() {
            const data = @json($nodes);
            let chart = new OrgChart(document.getElementById("chart-org"), {
                template: "ula",
                mode: 'light',
                enableAI: true,
                layout: OrgChart.mixed,
                mouseScrool: OrgChart.action.ctrlZoom,
                collapse: {
                    level: 2
                },
                nodeMenu: {
                    download: {
                        text: "Download File LHKPN",
                        icon: OrgChart.icon.pdf(24, 24, "#039BE5"),
                        onClick: function(args) {
                            const fileUrl = args.node.file_link;

                            if (fileUrl) {
                                const link = document.createElement('a');
                                link.href = fileUrl;
                                link.download = '';
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            } else {
                                alert("File tidak tersedia untuk diunduh.");
                            }
                        }
                    }
                },
                nodeBinding: {
                    field_0: "name", // Nama pegawai
                    field_1: "title", // Jabatan
                    field_2: "desc", // Tupoksi
                    field_3: "bidang", // Nama bidang
                    img_0: "img" // Foto
                }
            });



            chart.load(data);

        });
    </script>
@endpush
