@extends('backend.layout.master')

@section('judul')
    Edit Data RT
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Data Statistik Penduduk - {{ $jenisKelaminRt->rt }}</h3>
              </div>
              <form action="{{ route('jenis-kelamin-rt.update', $jenisKelaminRt->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                  <div class="form-group">
                    <label for="rt">RT</label>
                    <input type="text" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt', $jenisKelaminRt->rt) }}">
                    @error('rt')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="laki_laki">Laki-laki</label>
                    <input type="number" min="0" name="laki_laki" id="laki_laki" class="form-control @error('laki_laki') is-invalid @enderror" value="{{ old('laki_laki', $jenisKelaminRt->laki_laki) }}">
                    @error('laki_laki')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="perempuan">Perempuan</label>
                    <input type="number" min="0" name="perempuan" id="perempuan" class="form-control @error('perempuan') is-invalid @enderror" value="{{ old('perempuan', $jenisKelaminRt->perempuan) }}">
                    @error('perempuan')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="jumlah_kk">Jumlah Keluarga (KK)</label>
                    <input type="number" min="0" name="jumlah_kk" id="jumlah_kk" class="form-control @error('jumlah_kk') is-invalid @enderror" value="{{ old('jumlah_kk', $jenisKelaminRt->jumlah_kk) }}">
                    @error('jumlah_kk')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('jenis-kelamin-rt.index') }}" class="btn btn-secondary">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

@endsection