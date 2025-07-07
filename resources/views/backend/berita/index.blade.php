@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Berita
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
                <h3 class="card-title">Data Berita</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route ('berita.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Berita</th>
                    <th>Deskripsi</th>
                    <th>Penulis</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($berita as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$value->judul}}</td>
                          <td>{{$value->deskripsi}}</td>
                          <td>{{$value->penulis}}</td>
                          <td>
                            <img src="{{ asset('storage/berita/'.$value->foto) }}" style="width:300px; height:200px; object-fit:contain;">
                          </td>
                          <td>
                            <form action="{{ route('berita.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              @csrf
                              @method('DELETE')
                              <a href="{{ route ('berita.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                              <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                            </form>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center">Belum ada data berita</td>
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