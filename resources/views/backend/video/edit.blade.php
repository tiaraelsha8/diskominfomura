@extends('backend.layout.master')

@section('judul')
    Halaman Edit Video
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('video.update', $videos->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Judul Video</label>
                <input type="text" class="form-control" name="judul" value="{{$videos->judul}}">
            </div>
            @error('judul')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{$videos->deskripsi}}</textarea>
            @error('deskripsi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label for="image">Video</label>
                <input type="file" class="form-control-file" name="video" accept="videos/*">
            </div>
            @error('video')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route ('video.index') }}" class="btn btn-default">Kembali</a>
            </div>
    </form>
    </div>
</div>
@endsection
