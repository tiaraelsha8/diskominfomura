@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Kontak
@endsection

@section('content')
    <form action="{{ route('kontak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" placeholder="Isikan Lokasi">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="telepon" placeholder="Isikan Telepon">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Isikan Email">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror



            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('kontak.index') }}" class="btn btn-default">Kembali</a>
            </div>
    </form>
@endsection
