@extends('frontend.layout.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12 d-flex">
            <div class="card w-100">
                <div class="card-body px-4 text-center">
                    <div id="chart-org" style="height: 800px;"></div>
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
            let chart = new OrgChart(document.getElementById("chart-org"), {
                template: "ana",
                mode: 'light',
                enableAI: true,
                enableDragDrop: true,
                layout: OrgChart.mixed,
                mouseScrool: OrgChart.action.ctrlZoom,
                menu: {
                    pdf: {
                        text: "Export PDF"
                    },
                    png: {
                        text: "Export PNG"
                    },
                    svg: {
                        text: "Export SVG"
                    },
                    csv: {
                        text: "Export CSV"
                    }
                },
                nodeMenu: {
                    pdf: {
                        text: "Export PDF"
                    },
                    png: {
                        text: "Export PNG"
                    },
                    svg: {
                        text: "Export SVG"
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


            const data = @json($nodes);
            chart.load(data);

        });
    </script>
@endpush


{{-- [{
                    id: 1,
                    name: "Rudi Hartono",
                    title: "Kepala Dinas",
                    bidang: "Kepala Dinas",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 2,
                    pid: 1,
                    name: "Andi Saputra",
                    title: "Sekretaris Dinas",
                    bidang: "Sekretariat",
                    tags: ["assistant"],
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 3,
                    pid: 1,
                    name: "Siti Rahma",
                    title: "Kepala Bidang Infrastruktur",
                    bidang: "Infrastruktur",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 4,
                    pid: 3,
                    name: "Budi Santoso",
                    title: "Staf Bidang Infrastruktur",
                    bidang: "Infrastruktur",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 5,
                    pid: 3,
                    name: "Rina Dewi",
                    title: "Staf Bidang Infrastruktur",
                    bidang: "Infrastruktur",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 6,
                    pid: 2,
                    name: "Angga",
                    title: "Kepala Sub Bidang Keuangan",
                    bidang: "Sekretariat",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 7,
                    pid: 2,
                    name: "budi",
                    title: "Kepala Sub Bidang Hukum",
                    bidang: "Sekretariat",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 8,
                    pid: 6,
                    name: "charlie",
                    title: "Staff Sub Bidang Hukum",
                    bidang: "Sekretariat",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                },
                {
                    id: 9,
                    pid: 1,
                    name: "delta",
                    title: "Kepala Bidang TIK",
                    bidang: "Sekretariat",
                    img: "https://cdn-icons-png.flaticon.com/512/149/149071.png"
                }
            ] --}}