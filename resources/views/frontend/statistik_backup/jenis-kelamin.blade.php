{{-- resources/views/frontend/statistik/jenis-kelamin.blade.php --}}

@extends('frontend.layout.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.statistik._sidebar')
        </div>

        <div class="col-md-9">
            <h4 class="font-weight-bold mb-3">Tabel Jenis Kelamin</h4>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Jenis Kelamin</th>
                            <th>Jiwa</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row['label'] }}</td>
                                <td class="text-right">{{ $row['jumlah'] }}</td>
                                <td class="text-right">{{ $row['persen'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <td colspan="2" class="text-center">Total</td>
                            <td class="text-right">{{ $total }}</td>
                            <td class="text-right">100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection