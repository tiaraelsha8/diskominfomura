{{-- resources/views/backend/penduduk/edit.blade.php --}}

@extends('backend.layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Data Penduduk</h3>
    </div>

    <form action="{{ route('admin.penduduk.update', $penduduk->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('backend.penduduk._form')
    </form>
</div>
@endsection