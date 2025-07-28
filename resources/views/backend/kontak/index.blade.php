@extends('backend.layout.master')

@section('judul')
    Halaman Kelola Kontak
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
                        <h3 class="card-title">Data Kontak</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($kontak->count() < 1)
                            <a href="{{ route('kontak.create') }}" class="btn btn-primary btn-sm mb-3 mt-3">Tambah</a>
                        @endif
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lokasi</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Maps</th>
                                    <th>Instagram</th>
                                    <th>Facebook</th>
                                    <th>Twitter</th>
                                    <th>TikTok</th>
                                    <th>YouTube</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kontak as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->lokasi }}</td>
                                        <td>{{ $value->telepon }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                            <a href="{{ $value->linkmaps }}" target="_blank">
                                                Lihat di Maps
                                            </a>
                                        </td>
                                        <td>
                                            @if($value->link_ig)
                                                <a href="{{ $value->link_ig }}" target="_blank">Instagram</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->link_fb)
                                                <a href="{{ $value->link_fb }}" target="_blank">Facebook</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->link_twitter)
                                                <a href="{{ $value->link_twitter }}" target="_blank">Twitter</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->link_tiktok)
                                                <a href="{{ $value->link_tiktok }}" target="_blank">TikTok</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->link_youtube)
                                                <a href="{{ $value->link_youtube }}" target="_blank">YouTube</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('kontak.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('kontak.edit', $value->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data bidang</td>
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
