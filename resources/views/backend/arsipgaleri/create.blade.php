@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Galeri
@endsection

@section('content')
    <form action="{{ route('arsipgaleri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Galeri</label>
                <input type="text" class="form-control" name="nama_galeri" placeholder="Isikan Nama Galeri">
            </div>
            @error('nama_galeri')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group">
                <label for="image">Logo Kategori</label>
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
    </form>
@endsection