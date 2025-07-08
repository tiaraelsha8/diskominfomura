@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Pegawai
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
                        <h3 class="card-title">Data Pegawai</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm mb-3">Tambah</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Bidang</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pegawais as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ $value->nip }}</td>
                                        <td>{{ $value->jabatan }}</td>
                                        <td>{{ $value->bidang->nama_bidang }}</td>

                                        <td>
                                            <img src="{{ asset('storage/pegawai/' . $value->foto) }}"
                                                style="width:300px; height:200px; object-fit:contain;">
                                        </td>
                                        <td>
                                            <form action="{{ route('pegawai.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('pegawai.edit', $value->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <!-- Tombol Cetak -->
                                                <a href="{{ route('cetak.pegawai', $value->id) }}" target="_blank"
                                                    class="btn btn-primary btn-sm mt-1">Cetak</a>
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
