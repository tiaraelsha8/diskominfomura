@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Profil Bidang
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
                <h3 class="card-title">Data Profil Bidang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{ route ('profilbidang.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($profilbidangs as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$value->nama_bidang}}</td>
                          <td>{!!$value->deskripsi!!}</td>
                          <td>
                            <img src="{{ asset('storage/profilbidang/'.$value->foto) }}" style="width:300px; height:200px; object-fit:contain;">
                          </td>
                          <td>
                            <form action="{{ route('profilbidang.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              @csrf
                              @method('DELETE')
                              <a href="{{ route ('profilbidang.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                              <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                            </form>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center">Belum ada data profil bidang</td>
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