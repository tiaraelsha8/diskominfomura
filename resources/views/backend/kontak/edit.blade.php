@extends('backend.layout.master')

@section('judul')
    Halaman Edit Kontak
@endsection

@section('content')
    <form action="{{ route('kontak.update', $kontak->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="{{$kontak->lokasi}}">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="telepon" value="{{$kontak->telepon}}">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{$kontak->email}}">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror





            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('galeri.index') }}" class="btn btn-default">Kembali</a>
            </div>
    </form>
@endsection
