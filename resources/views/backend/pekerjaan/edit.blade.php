@extends('backend.layout.master')

@section('judul')
    Edit Data Pekerjaan
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Edit Pekerjaan</h3>
              </div>
              <div class="card-body">

                <form action="{{ route('pekerjaan.update', $pekerjaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" value="{{ $pekerjaan->pekerjaan }}" disabled readonly>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Laki-laki (Jiwa)</label>
                            <input type="number" min="0" name="laki_laki" class="form-control @error('laki_laki') is-invalid @enderror"
                                   value="{{ old('laki_laki', $pekerjaan->laki_laki) }}" required>
                            @error('laki_laki') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Perempuan (Jiwa)</label>
                            <input type="number" min="0" name="perempuan" class="form-control @error('perempuan') is-invalid @enderror"
                                   value="{{ old('perempuan', $pekerjaan->perempuan) }}" required>
                            @error('perempuan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary">Batal</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

@endsection