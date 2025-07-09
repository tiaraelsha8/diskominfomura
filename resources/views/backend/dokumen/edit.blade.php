@extends('backend.layout.master')

@section('judul')
    Halaman Edit Berita
@endsection

@section('content')
    <form action="{{ route('dokumen.update', $dokumens->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Nama Dokumen</label>
                <input type="text" class="form-control" name="nama_dok" value="{{$dokumens->nama_dok}}">
            </div>
            @error('nama_dok')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan" value="{{$dokumens->keterangan}}">
            </div>
            @error('keterangan')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="file">Dokumen</label>
                <input type="file" class="form-control-file" name="file" accept=".pdf">
            </div>
            @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('dokumen.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
@endsection
