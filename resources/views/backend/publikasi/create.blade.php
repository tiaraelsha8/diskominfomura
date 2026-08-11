@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Publikasi
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('publikasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Judul Publikasi</label>
                <input type="text" class="form-control" name="judul" placeholder="Isikan Judul Publikasi">
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
                <label for="foto">Cover Publikasi</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
                <p>jpg,jpeg,png. max 2 MB</p>
            </div>
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="file">File Publikasi (PDF)</label>
                <input type="file" class="form-control-file" name="file" accept="application/pdf">
                <p>pdf. max 20 MB</p>
            </div>
            @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('publikasi.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div> 
    </form>
    </div>
</div>
@endsection