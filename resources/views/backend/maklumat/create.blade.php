<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
@extends('backend.layout.master')

@section('judul')
    Halaman Tambah Maklumat
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('maklumat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="tentang">Maklumat</label>
                        <textarea name="maklumat" id="editor" class="form-control"></textarea>
                        {{-- <div id="editor1"></div> --}}
                        @error('maklumat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <p>jpg,jpeg,png. max 2 MB</p>
                        @error('foto')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">Video</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                        <p>mp4. max 20 MB</p>
                        @error('video')
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
                    'redo',

                ],
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                }
            })
            .catch(error => console.error(error));
    </script>
    <script>
        const initialData = {
            // `about` is a Delta object
            // Learn more at: https://quilljs.com/docs/delta
            maklumat: [{
                insert: 'Maklumat Layanan',
            }, ],
        };

        const quill = new Quill('#editor1', {
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    ['link', 'blockquote', 'code-block', 'image'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                ],
            },
            theme: 'snow',
        });

        const resetForm = () => {
            quill.setContents(initialData.maklumat);
        };

        resetForm();

        const form = document.querySelector('form');
        form.addEventListener('formdata', (event) => {
            // Append Quill content before submitting
            event.formData.append('maklumat', JSON.stringify(quill.getContents().ops));
        });

        document.querySelector('#resetForm').addEventListener('click', () => {
            resetForm();
        });
    </script>
@endpush
