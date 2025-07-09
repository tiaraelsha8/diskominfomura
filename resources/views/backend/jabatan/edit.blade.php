@extends('backend.layout.master')

@section('judul')
    Halaman Edit Jabatan
@endsection

@section('content')
    <form action="{{ route('jabatan.update', $jabatans->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Nama Jabatan</label>
                <input type="text" class="form-control" name="nama_jabatan" value="{{$jabatans->nama_jabatan}}">
            </div>
            @error('nama_jabatan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('jabatan.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
@endsection
