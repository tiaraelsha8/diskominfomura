@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Lokasi Internet
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('lokasi.store') }}" method="POST">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Lokasi</label>
                <input type="text" class="form-control" name="nama_lokasi" placeholder="Isikan Nama Lokasi">
            </div>
            @error('nama_lokasi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Latitude</label>
                <input type="text" id="latitude" class="form-control" name="latitude" placeholder="Isikan Nama Lokasi">
            </div>
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Longitude</label>
                <input type="text" id="longitude" class="form-control" name="longitude" placeholder="Isikan Nama Lokasi">
            </div>
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="4"></textarea>
            @error('keterangan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('bidang.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

