@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Logo
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('logo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Dinas</label>
                <input type="text" class="form-control" name="judul" placeholder="Isikan Nama Dinas">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group">
                <label for="image">Logo</label>
                <input type="file" class="form-control-file" name="foto" accept="image/*">
            </div>
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('logo.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
