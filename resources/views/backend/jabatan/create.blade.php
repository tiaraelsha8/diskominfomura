@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Bidang
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('jabatan.store') }}" method="POST">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Jabatan</label>
                <input type="text" class="form-control" name="nama_jabatan" placeholder="Isikan Nama JaBatan">
            </div>
            @error('nama_jabatan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>Isikan dengan awalan huruf besar, contoh : Pranata Komputer, Arsiparis</p>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jabatan.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
