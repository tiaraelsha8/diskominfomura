{{--
    resources/views/backend/statistik/partials/import-dropdown.blade.php
    Wajib kirim variabel: $routePrefix (cth: 'rentang-umur') dan $title (cth: 'Rentang Umur')
--}}

@php
    $modalId = 'importModal-' . $routePrefix;
@endphp

<div class="dropdown d-inline-block mb-3">
    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
            id="dropdownImport-{{ $routePrefix }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-file-excel"></i> Kelola via Excel
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownImport-{{ $routePrefix }}">
        <a class="dropdown-item" href="{{ route($routePrefix . '.template') }}">
            <i class="fas fa-download mr-1"></i> Download Template
        </a>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#{{ $modalId }}">
            <i class="fas fa-upload mr-1"></i> Import Data
        </a>
    </div>
</div>

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route($routePrefix . '.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File Template (.xlsx) yang Sudah Diisi</label>
                        <input type="file" name="file" class="form-control-file" accept=".xlsx,.xls" required>
                        <small class="form-text text-muted">
                            Gunakan file hasil "Download Template" — jangan ubah nama baris pada kolom {{ $title }},
                            cukup isi angka pada kolom Laki-laki dan Perempuan.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>