@extends('frontend.layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('templateadmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templateadmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="container mt-5 pt-5 mb-4">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.statistik._sidebar')
        </div>

        <div class="col-md-9">
            <h4 class="font-weight-bold mb-3">Tabel Rentang Umur</h4>

            <div class="table-responsive">
                <table id="tabelRentangUmur" class="table table-bordered table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Kelompok</th>
                            <th colspan="2">Jumlah</th>
                            <th colspan="2">Laki-laki</th>
                            <th colspan="2">Perempuan</th>
                        </tr>
                        <tr>
                            <th>Jiwa</th><th>%</th>
                            <th>Jiwa</th><th>%</th>
                            <th>Jiwa</th><th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row['label'] }}</td>
                                <td class="text-right">{{ $row['jumlah'] }}</td>
                                <td class="text-right">{{ $row['jumlah_persen'] }}</td>
                                <td class="text-right">{{ $row['laki'] }}</td>
                                <td class="text-right">{{ $row['laki_persen'] }}</td>
                                <td class="text-right">{{ $row['perempuan'] }}</td>
                                <td class="text-right">{{ $row['perempuan_persen'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data penduduk</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <td colspan="2" class="text-center">Total</td>
                            <td class="text-right">{{ $total['jumlah'] }}</td>
                            <td class="text-right">100%</td>
                            <td class="text-right">{{ $total['laki'] }}</td>
                            <td class="text-right">100%</td>
                            <td class="text-right">{{ $total['perempuan'] }}</td>
                            <td class="text-right">100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('templateadmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templateadmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templateadmin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('templateadmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#tabelRentangUmur').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: { previous: "Sebelumnya", next: "Selanjutnya" },
                zeroRecords: "Data tidak ditemukan"
            }
        });
    });
</script>
@endpush