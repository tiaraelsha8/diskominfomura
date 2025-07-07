@extends('backend.layout.master')

@section('judul')
    Halaman Edit Tentang
@endsection

@section('content')
    <form action="{{ route('tentang.update', $tentangs->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label for="tentang">Tentang</label>
                <textarea name="tentang" id="editor" class="form-control">{{$tentangs->tentang}}</textarea>
                @error('tentang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tentang.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </div>
    </form>
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
