@extends('backend.layout.master')

@section('judul')
    Halaman Edit pengumuman
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">

                    <div class="form-group">
                        <label>Judul Galeri</label>
                        <input type="text" class="form-control" name="judul" value="{{ $pengumuman->judul }}">
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ $pengumuman->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="penulis" value="{{ $pengumuman->penulis }}">
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" class="form-control-file" name="foto" accept="image/*">
                    </div>
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="file">Dokumen</label>
                        <input type="file" class="form-control-file" name="file" accept=".pdf">
                    </div>
                    @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
