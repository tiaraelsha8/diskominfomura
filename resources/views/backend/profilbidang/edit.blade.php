@extends('backend.layout.master')

@section('judul')
    Halaman Edit Profil Bidang
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('profilbidang.update', $profilbidangs->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label>Nama Bidang</label>
                <input type="text" class="form-control" name="nama_bidang" value="{{$profilbidangs->nama_bidang}}">
            </div>
            @error('nama_bidang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

             <div class="form-group">
                <label for="tentang">Deskripsi</label>
                <textarea name="deskripsi" id="editor" class="form-control">{{$profilbidangs->deskripsi}}</textarea>
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
