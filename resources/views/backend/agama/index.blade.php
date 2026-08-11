@extends('backend.layout.master')

@section('judul')
    Statistik Agama
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Statistik Agama</h3>
              </div>
              <div class="card-body">
                @include('backend.statistik.partials.import-dropdown', ['routePrefix' => 'agama', 'title' => 'Agama'])
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Agama</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                    @forelse ($agamas as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td class="text-left">{{ $value->agama }}</td>
                          <td>{{ $value->laki_laki }}</td>
                          <td>{{ $value->perempuan }}</td>
                          <td>{{ $value->jumlah }}</td>
                          <td>
                            <a href="{{ route ('agama.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center">Belum ada data. Jalankan seeder terlebih dahulu.</td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection