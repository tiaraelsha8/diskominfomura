@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Pengumuman
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
                        <h3 class="card-title">Data Pengumuman</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('pengumuman.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul pengumuman</th>
                                    <th>Deskripsi</th>
                                    <th>Penulis</th>
                                    <th>Foto</th>
                                    <th>Dokumen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengumuman as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->judul }}</td>
                                        <td>{{ $value->deskripsi }}</td>
                                        <td>{{ $value->penulis }}</td>
                                        <td>
                                            <img src="{{ asset('storage/pengumuman/' . $value->foto) }}"
                                                style="width:300px; height:200px; object-fit:contain;">
                                        </td>
                                        <td>
                                            @if ($value->file)
                                                <a href="{{ route('pengumuman.download', $value->id) }}"
                                                    target="_blank">Download</a>
                                            @else
                                                <em>Belum ada file</em>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('pengumuman.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('pengumuman.edit', $value->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data pengumuman</td>
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
