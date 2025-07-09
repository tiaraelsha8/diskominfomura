@extends('backend.layout.master')

@section('judul')
    Halaman Edit Bidang
@endsection

@section('content')
    <form action="{{ route('bidang.update', $bidangs->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Nama bidang</label>
                <input type="text" class="form-control" name="nama_bidang" value="{{$bidangs->nama_bidang}}">
            </div>
            @error('nama_bidang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('bidang.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
@endsection
