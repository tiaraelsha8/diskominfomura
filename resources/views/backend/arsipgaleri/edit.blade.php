@extends('backend.layout.master')

@section('judul')
    Halaman Edit Galeri
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('arsipgaleri.update', $arsipgaleris->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">

                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_galeri" value="{{ $arsipgaleris->nama_galeri }}">
                    </div>
                    @error('nama_galeri')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" class="form-control-file" name="foto" accept="image/*">
                        <p>png. max 2 MB</p>
                    </div>
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('arsipgaleri.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection