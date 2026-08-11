{{-- resources/views/backend/penduduk/_form.blade.php --}}

<div class="card-body">
    @php $p = $penduduk ?? null; @endphp

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jk" class="form-control" required>
            <option value="L" {{ old('jk', $p->jk ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jk', $p->jk ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>Umur</label>
        <input type="number" name="umur" class="form-control" value="{{ old('umur', $p->umur ?? '') }}">
    </div>

    <div class="form-group">
        <label>Status Kawin</label>
        <input type="text" name="status_kawin" class="form-control" value="{{ old('status_kawin', $p->status_kawin ?? '') }}">
    </div>

    <div class="form-group">
        <label>Agama</label>
        <input type="text" name="agama" class="form-control" value="{{ old('agama', $p->agama ?? '') }}">
    </div>

    <div class="form-group">
        <label>Hubungan dengan KRT</label>
        <input type="text" name="hub_krt" class="form-control" value="{{ old('hub_krt', $p->hub_krt ?? '') }}">
    </div>

    <div class="form-group">
        <label>Jenjang Pendidikan</label>
        <input type="text" name="jenjang" class="form-control" value="{{ old('jenjang', $p->jenjang ?? '') }}">
    </div>

    <div class="form-group">
        <label>Ijazah Terakhir</label>
        <input type="text" name="ijazah" class="form-control" value="{{ old('ijazah', $p->ijazah ?? '') }}">
    </div>

    <div class="form-group">
        <label>Status Bekerja</label>
        <input type="text" name="status_bekerja" class="form-control" value="{{ old('status_bekerja', $p->status_bekerja ?? '') }}">
    </div>

    <div class="form-group">
        <label>Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $p->pekerjaan ?? '') }}">
    </div>

    <div class="form-group">
        <label>Sektor</label>
        <input type="text" name="sektor" class="form-control" value="{{ old('sektor', $p->sektor ?? '') }}">
    </div>

    <div class="form-group">
        <label>Jenis Disabilitas</label>
        <input type="text" name="jenis_disabilitas" class="form-control" value="{{ old('jenis_disabilitas', $p->jenis_disabilitas ?? '') }}">
    </div>

    <div class="form-group">
        <label>Jenis Penyakit</label>
        <input type="text" name="jenis_penyakit" class="form-control" value="{{ old('jenis_penyakit', $p->jenis_penyakit ?? '') }}">
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">Batal</a>
</div>