@extends('backend.layout.master')

@section('judul')
    Halaman Edit Pegawai
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('pegawai.update', $pegawais->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ $pegawais->nama }}">
                    </div>
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" value="{{ $pegawais->nip }}">
                    </div>
                    @error('nip')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>janatan</label>
                        <input type="text" class="form-control" name="jabatan" value="{{ $pegawais->jabatan }}">
                    </div>
                    @error('jabatan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang_id" class="form-control" id="">
                            <option value="">-- Pilih Bidang --</option>
                            @forelse ($bidangs as $item)
                                @if ($item->id === $pegawais->bidang_id)
                                    <option value="{{ $item->id }}" selected> {{ $item->nama_bidang }} </option>
                                @else
                                    <option value="{{ $item->id }}"> {{ $item->nama_bidang }} </option>
                                @endif
                            @empty
                                <option value="">Tidak Ada Data Bidang</option>
                            @endforelse
                        </select>
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
