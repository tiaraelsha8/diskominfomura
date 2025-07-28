@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Profil Bidang
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('profilbidang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label>Nama Bidang</label>
                <input type="text" class="form-control" name="nama_bidang" placeholder="Isikan Judul Galeri">
            </div>
            @error('nama_bidang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="tentang">Deskripsi</label>
                <textarea name="deskripsi" id="editor" class="form-control"></textarea>
                @error('deskripsi')
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
                <a href="{{ route ('profilbidang.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div> 
    </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
          .create(document.querySelector('#editor'), {
            toolbar: [
              'heading',
              'bold',
              'italic',
              'underline',
              'bulletedList',
              'numberedList',
              'alignment',
              'link',
              'undo',
              'redo'
            ],
            alignment: {
              options: [ 'left', 'center', 'right', 'justify' ]
            }
          })
          .catch(error => console.error(error));
      </script>
@endpush
