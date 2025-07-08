@extends('backend.layout.master')

@section('judul')
    Halaman Tambah pengumuman
@endsection

@section('content')
    <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Judul pengumuman</label>
                <input type="text" class="form-control" name="judul" placeholder="Isikan Judul pengumuman">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
            @error('deskripsi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" class="form-control" name="penulis" placeholder="Isikan Penulis">
            </div>
            @error('penulis')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="image">Foto</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
            </div>
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('pengumuman.index') }}" class="btn btn-default">Kembali</a>
            </div>
    </form>
@endsection
