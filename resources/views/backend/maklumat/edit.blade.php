@extends('backend.layout.master')

@section('judul')
    Halaman Edit Maklumat
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    <form action="{{ route('maklumat.update', $tentangs->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">

            <div class="form-group">
                <label for="tentang">Maklumat</label>
                <textarea name="maklumat" id="editor" class="form-control">{{$maklumats->maklumat}}</textarea>
                @error('maklumat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('maklumat.index') }}" class="btn btn-default">Kembali</a>
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
