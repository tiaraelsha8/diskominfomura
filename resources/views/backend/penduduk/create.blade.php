{{-- resources/views/backend/penduduk/create.blade.php --}}

@extends('backend.layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Penduduk</h3>
    </div>

    <form action="{{ route('admin.penduduk.store') }}" method="POST">
        @csrf
        @include('backend.penduduk._form')
    </form>
</div>
@endsection