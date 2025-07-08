@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Pegawai
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form method="POST" action="{{ route('pegawai.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-2">
                    <label>Pilih File</label>
                    <input type="file" name="file" class="form-control">
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary">Submit</button>
                </div>

            </form>

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
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" placeholder="Isikan NIP Pegawai">
                    </div>
                    @error('nip')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" placeholder="Isikan Jabatan Pegawai">
                    </div>
                    @error('jabatan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang_id" class="form-control" id="">
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
