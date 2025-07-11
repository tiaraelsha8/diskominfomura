@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Carousel
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Judul Carousel</label>
                <input type="text" class="form-control" name="judul" placeholder="Isikan Judul Galeri">
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

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('carousel.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
