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
                        <select name="jabatan_id" id="jabatanSelect" class="form-control">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatans as $item)
                                <option value="{{ $item->id }}" data-nama="{{ $item->nama_jabatan }}">
                                    {{ $item->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('jabatan_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Bidang</label>
                        <select name="bidang_id" id="bidangSelect" class="form-control">
                            <option value="">-- Pilih Bidang --</option>
                            @foreach ($bidangs as $item)
                                <option value="{{ $item->id }}" data-nama="{{ $item->nama_bidang }}">
                                    {{ $item->nama_bidang }}
                                </option>
                            @endforeach
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

    {{-- Script untuk sinkronisasi pilihan --}}
    <script>
        document.getElementById('jabatanSelect').addEventListener('change', function() {
            const selectedJabatan = this.options[this.selectedIndex].text.trim();
            const bidangSelect = document.getElementById('bidangSelect');

            // Jika jabatan = "Kepala Dinas", maka pilih bidang "Kepala Dinas"
            if (selectedJabatan === 'Kepala Dinas') {
                const options = bidangSelect.options;
                for (let i = 0; i < options.length; i++) {
                    if (options[i].text.trim() === 'Kepala Dinas') {
                        bidangSelect.selectedIndex = i;
                        break;
                    }
                }
            } else {
                // Reset bidang kalau bukan "Kepala Dinas"
                bidangSelect.selectedIndex = 0;
            }
        });
    </script>
@endsection
