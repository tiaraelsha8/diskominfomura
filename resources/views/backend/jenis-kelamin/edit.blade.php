@extends('backend.layout.master')

@section('judul')
    Edit Data Penduduk
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Edit Penduduk</h3>
              </div>
              <div class="card-body">

                <form action="{{ route('jenis-kelamin.update', $jenisKelamin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Kelompok</label>
                        <input type="text" class="form-control" value="{{ $jenisKelamin->jenis_kelamin }}" disabled readonly>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Laki-laki (Jiwa)</label>
                            <input type="number" min="0" name="laki_laki" class="form-control @error('laki_laki') is-invalid @enderror"
                                   value="{{ old('laki_laki', $jenisKelamin->laki_laki) }}" required>
                            @error('laki_laki') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Perempuan (Jiwa)</label>
                            <input type="number" min="0" name="perempuan" class="form-control @error('perempuan') is-invalid @enderror"
                                   value="{{ old('perempuan', $jenisKelamin->perempuan) }}" required>
                            @error('perempuan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Jumlah Keluarga (KK)</label>
                            <input type="number" min="0" name="jumlah_kk" class="form-control @error('jumlah_kk') is-invalid @enderror"
                                   value="{{ old('jumlah_kk', $jenisKelamin->jumlah_kk) }}" required>
                            @error('jumlah_kk') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('jenis-kelamin.index') }}" class="btn btn-secondary">Batal</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

@endsection