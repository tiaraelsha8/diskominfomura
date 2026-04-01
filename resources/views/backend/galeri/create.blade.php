@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Foto
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>Judul Galeri</label>
                        <input type="text" class="form-control" name="judul" placeholder="Isikan Judul Galeri">
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                        @error('deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="arsipgaleri_id" class="form-control" id="">
                            <option value="">-- Pilih Galeri --</option>
                            @forelse ($arsipgaleris as $item)
                                <option value="{{ $item->id }}"> {{ $item->nama_galeri }} </option>
                            @empty
                                <option value="">Tidak Ada Data Galeri</option>
                            @endforelse
                        </select>
                    </div>
                    @error('arsipgaleri_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" class="form-control-file" name="foto" accept="image/*">
                        <p>jpg,jpeg,png. max 2 MB</p>
                    </div>
                    @error('foto')
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