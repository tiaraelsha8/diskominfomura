@extends('backend.layout.master')

@section('judul')
    Tambah Data RT
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Statistik Penduduk per RT</h3>
              </div>
              <form action="{{ route('jenis-kelamin-rt.store') }}" method="POST">
                @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="rt">RT</label>
                    <input type="text" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}" placeholder="Contoh: RT 01">
                    @error('rt')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="laki_laki">Laki-laki</label>
                    <input type="number" min="0" name="laki_laki" id="laki_laki" class="form-control @error('laki_laki') is-invalid @enderror" value="{{ old('laki_laki', 0) }}">
                    @error('laki_laki')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="perempuan">Perempuan</label>
                    <input type="number" min="0" name="perempuan" id="perempuan" class="form-control @error('perempuan') is-invalid @enderror" value="{{ old('perempuan', 0) }}">
                    @error('perempuan')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="jumlah_kk">Jumlah Keluarga (KK)</label>
                    <input type="number" min="0" name="jumlah_kk" id="jumlah_kk" class="form-control @error('jumlah_kk') is-invalid @enderror" value="{{ old('jumlah_kk', 0) }}">
                    @error('jumlah_kk')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ route('jenis-kelamin-rt.index') }}" class="btn btn-secondary">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection