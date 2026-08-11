@extends('backend.layout.master')

@section('judul')
    Statistik Penduduk
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
                <h3 class="card-title">Data Statistik Penduduk</h3>
              </div>
              <div class="card-body">
                @include('backend.statistik.partials.import-dropdown', ['routePrefix' => 'jenis-kelamin', 'title' => 'Penduduk'])
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Jumlah Penduduk</th>
                    <th>Jumlah Keluarga</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                    @forelse ($jenisKelamins as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td class="text-left">{{ $value->jenis_kelamin }}</td>
                          <td>{{ $value->laki_laki }}</td>
                          <td>{{ $value->perempuan }}</td>
                          <td>{{ $value->jumlah }}</td>
                          <td>{{ $value->jumlah_kk }}</td>
                          <td>
                            <a href="{{ route ('jenis-kelamin.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">Belum ada data. Jalankan seeder terlebih dahulu.</td>
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