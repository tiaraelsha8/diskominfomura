@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Pegawai
@endsection

@section('content')
    <div class="card">
        <div class="card-header">

            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Isikan Nama Pegawai">
                    </div>
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan_id" class="form-control" id="jabatan_id">
                            <option value="">-- Pilih Jabatan --</option>
                            @forelse ($jabatans as $item)
                                <option value="{{ $item->id }}"> {{ $item->nama_jabatan }} </option>
                            @empty
                                <option value="">Tidak Ada Data Jabatan</option>
                            @endforelse
                        </select>
                    </div>
                    @error('jabatan_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="bidang_id">Bidang</label>
                        <select name="bidang_id" class="form-control" id="bidang_id">
                            <option value="">-- Pilih Bidang --</option>
                            @forelse ($bidangs as $item)
                                <option value="{{ $item->id }}"> {{ $item->nama_bidang }} </option>
                            @empty
                                <option value="">Tidak Ada Data Bidang</option>
                            @endforelse
                        </select>
                    </div>
                    @error('bidang_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="tupoksi">Tupoksi</label>
                        <textarea name="tupoksi" class="form-control" rows="4"></textarea>
                        @error('tupoksi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" class="form-control-file" name="foto" accept="image/*">
                    </div>
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
