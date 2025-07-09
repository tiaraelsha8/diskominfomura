@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Lokasi Internet
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
                        <h3 class="card-title">Data Lokasi Internet</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('lokasi.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lokasi as $key => $value)
                                    <tr>
                                        <td>{{ $value->nama_lokasi }}</td>
                                        <td>{{ $value->latitude }}</td>
                                        <td>{{ $value->longitude }}</td>
                                        <td>{{ $value->keterangan }}</td>
                                        <td>
                                            <form action="{{ route('lokasi.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('lokasi.edit', $value->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data pegawai</td>
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
