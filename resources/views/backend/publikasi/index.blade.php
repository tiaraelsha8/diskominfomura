@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Publikasi
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Publikasi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route ('publikasi.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Publikasi</th>
                    <th>Deskripsi</th>
                    <th>Cover</th>
                    <th>File</th>
                    <th>Unduhan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($publikasi as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$value->judul}}</td>
                          <td>{{$value->deskripsi}}</td>
                          <td>
                            @if ($value->foto)
                                <img src="{{ asset('storage/publikasi/'.$value->foto) }}" style="width:300px; height:200px; object-fit:contain;">
                            @else
                                <span class="text-muted">Tidak ada cover</span>
                            @endif
                          </td>
                          <td>{{ $value->file_original_name }}</td>
                          <td>{{ $value->download_count }}</td>
                          <td>
                            <form action="{{ route('publikasi.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              @csrf
                              @method('DELETE')
                              <a href="{{ route ('publikasi.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                              <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                            </form>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">Belum ada data publikasi</td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

@endsection