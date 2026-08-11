{{-- resources/views/frontend/statistik/agama.blade.php --}}

@extends('frontend.layout.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.statistik._sidebar')
        </div>

        <div class="col-md-9">
            <h4 class="font-weight-bold mb-3">Tabel Agama</h4>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Agama</th>
                            <th colspan="2">Jumlah</th>
                            <th rowspan="2" class="align-middle">Laki-laki</th>
                            <th rowspan="2" class="align-middle">Perempuan</th>
                        </tr>
                        <tr>
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
                                <td class="text-right">{{ $row['perempuan'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data penduduk</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <td colspan="2" class="text-center">Total</td>
                            <td class="text-right">{{ $total }}</td>
                            <td class="text-right">100%</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection