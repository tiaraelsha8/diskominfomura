{{-- resources/views/backend/penduduk/index.blade.php --}}

@extends('backend.layout.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Penduduk</h3>
        <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari pekerjaan/agama..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>JK</th>
                        <th>Umur</th>
                        <th>Status Kawin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penduduks as $i => $p)
                        <tr>
                            <td>{{ $penduduks->firstItem() + $i }}</td>
                            <td>{{ $p->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $p->umur ?? '-' }}</td>
                            <td>{{ $p->status_kawin ?? '-' }}</td>
                            <td>{{ $p->agama ?? '-' }}</td>
                            <td>{{ $p->pekerjaan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.penduduk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.penduduk.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $penduduks->links() }}
    </div>
</div>
@endsection