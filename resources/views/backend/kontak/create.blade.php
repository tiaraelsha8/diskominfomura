@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Kontak
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('kontak.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" placeholder="Isikan Lokasi">
                    </div>
                    @error('lokasi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Google Maps</label>
                        <input type="url" name="linkmaps" class="form-control"
                            placeholder="https://maps.app.goo.gl/...">
                    </div>
                    @error('linkmaps')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="telepon" placeholder="Isikan Telepon">
                    </div>
                    @error('telepon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Isikan Email @">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Instagram</label>
                        <input type="url" class="form-control" name="link_ig" placeholder="https://instagram.com/...">
                    </div>
                    @error('link_ig')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Facebook</label>
                        <input type="url" class="form-control" name="link_fb" placeholder="https://facebook.com/...">
                    </div>
                    @error('link_fb')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Twitter</label>
                        <input type="url" class="form-control" name="link_twitter"
                            placeholder="https://twitter.com/...">
                    </div>
                    @error('link_twitter')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link TikTok</label>
                        <input type="url" class="form-control" name="link_tiktok" placeholder="https://x.com/@...">
                    </div>
                    @error('link_tiktok')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link YouTube</label>
                        <input type="url" class="form-control" name="link_youtube"
                            placeholder="https://youtube.com/@...">
                    </div>
                    @error('link_youtube')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kontak.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
