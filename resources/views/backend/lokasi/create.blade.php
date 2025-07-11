@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Lokasi Internet
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importModal">
                Import Lokasi dari File
            </button>

            <!-- Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{ route('lokasi.import') }}" enctype="multipart/form-data"
                        class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Lokasi Internet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="file">Pilih File</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>



            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>Nama Lokasi</label>
                        <input type="text" class="form-control" name="nama_lokasi" placeholder="Isikan Nama Lokasi">
                    </div>
                    @error('nama_lokasi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" id="latitude" class="form-control" name="latitude"
                            placeholder="Isikan Latitude">
                    </div>
                    @error('latitude')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" id="longitude" class="form-control" name="longitude"
                            placeholder="Isikan Longitude">
                    </div>
                    @error('longitude')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="deskripsi">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
                        @error('keterangan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('bidang.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
