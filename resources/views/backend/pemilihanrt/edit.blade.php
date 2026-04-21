@extends('backend.layout.master')

@section('judul')
    Halaman Edit Galeri
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('pemilihanrt.update', $pemilihanrts->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">

                    <div class="form-group">
                        <label>Nama RT</label>
                        <input type="text" class="form-control" name="nama_rt" value="{{$pemilihanrts->nama_rt}}">
                    </div>
                    @error('nama_rt')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Pemilihan</label>
                        <input type="text" class="form-control" name="link_pemilihan"
                            value="{{$pemilihanrts->link_pemilihan}}">
                    </div>
                    @error('link_pemilihan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Link Hasil</label>
                        <input type="text" class="form-control" name="link_hasil" value="{{$pemilihanrts->link_hasil}}">
                    </div>
                    @error('link_hasil')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pemilihanrt.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection