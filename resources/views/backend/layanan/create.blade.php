@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Layanan
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" class="form-control" name="nama_layanan" placeholder="Isikan Nama Layanan">
            </div>
            @error('nama_layanan')
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
                <label>Link Layanan</label>
                <input type="text" class="form-control" name="link" placeholder="Isikan Nama Layanan">
            </div>
            @error('link')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="image">Logo</label>
                <input type="file" class="form-control-file" name="logo" accept="image/*">
            </div>
            @error('logo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="image">Background</label>
                <input type="file" class="form-control-file" name="background" accept="image/*">
            </div>
            @error('background')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('layanan.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
