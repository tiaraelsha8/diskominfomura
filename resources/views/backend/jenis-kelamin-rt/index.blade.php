@extends('backend.layout.master')

@section('judul')
    Statistik Penduduk per RT
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Data Statistik Penduduk per RT</h3>
                <a href="{{ route('jenis-kelamin-rt.create') }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> Tambah RT
                </a>
              </div>
              <div class="card-body">
                 @include('backend.statistik.partials.import-dropdown', ['routePrefix' => 'jenis-kelamin-rt', 'title' => 'Penduduk per RT'])
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>RT</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Jumlah Penduduk</th>
                    <th>Jumlah Keluarga</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                    @forelse ($jenisKelaminRts as $key => $value)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td class="text-left">{{ $value->rt }}</td>
                          <td>{{ $value->laki_laki }}</td>
                          <td>{{ $value->perempuan }}</td>
                          <td>{{ $value->jumlah }}</td>
                          <td>{{ $value->jumlah_kk }}</td>
                          <td>
                            <a href="{{ route('jenis-kelamin-rt.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jenis-kelamin-rt.destroy', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data {{ $value->rt }}?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">Belum ada data RT. Silakan tambah data terlebih dahulu.</td>
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