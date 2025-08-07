@extends('backend.layout.master')

@section('judul')
    Halaman Edit Kontak
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('kontak.update', $kontak->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" value="{{ $kontak->lokasi }}">
                    </div>
                    @error('lokasi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Google Maps</label>
                        <input type="url" name="linkmaps" class="form-control" value="{{ $kontak->linkmaps }}">
                    </div>
                    @error('linkmaps')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="telepon" value="{{ $kontak->telepon }}">
                    </div>
                    @error('telepon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $kontak->email }}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Instagram</label>
                        <input type="url" class="form-control" name="link_ig" value="{{ $kontak->link_ig }}">
                    </div>
                    @error('link_ig')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Facebook</label>
                        <input type="url" class="form-control" name="link_fb" value="{{ $kontak->link_fb }}">
                    </div>
                    @error('link_fb')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Twitter</label>
                        <input type="url" class="form-control" name="link_twitter" value="{{ $kontak->link_twitter }}">
                    </div>
                    @error('link_twitter')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link TikTok</label>
                        <input type="url" class="form-control" name="link_tiktok" value="{{ $kontak->link_tiktok }}">
                    </div>
                    @error('link_tiktok')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link YouTube</label>
                        <input type="url" class="form-control" name="link_youtube" value="{{ $kontak->link_youtube }}">
                    </div>
                    @error('link_youtube')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('galeri.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
