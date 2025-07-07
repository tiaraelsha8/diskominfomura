@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Tentang
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
                <h3 class="card-title">Data Tentang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($tentangs->count() < 1)
                    <a href="{{ route ('tentang.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tentang</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($tentangs as $key => $value)
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{!!$value->tentang!!}</td>
                          <td>
                            <form action="{{ route('tentang.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              @csrf
                              @method('DELETE')
                              <a href="{{ route ('tentang.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                              <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                            </form>
                          </td>
                        </tr>
                    @empty
                    <tr>
                      <td colspan="3" class="text-center">Belum ada data tentang</td>
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