@extends('backend.layout.master')

@section('judul')
    Halaman Edit Lokasi Internet
@endsection

@section('content')
    <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Nama Lokasi</label>
                <input type="text" class="form-control" name="nama_lokasi" value="{{$lokasi->nama_lokasi}}">
            </div>
            @error('nama_lokasi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Latitude</label>
                <input type="text" id="latitude" class="form-control" name="latitude" value="{{$lokasi->latitude}}">
            </div>
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Longitude</label>
                <input type="text" id="longitude" class="form-control" name="longitude" value="{{$lokasi->longitude}}">
            </div>
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="4">{{$lokasi->keterangan}}</textarea>
            @error('keterangan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('lokasi.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
@endsection
