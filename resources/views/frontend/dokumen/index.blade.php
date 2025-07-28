@extends('frontend.layout.app')

@section('content')
    <!-- ======= Dokumen Start ======= -->
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="case-details__article">
                <h2 class="mb-4 fw-bold">Dokumen</h2>

                {{-- search & filter --}}
                <form id="filterForm" method="GET" action="{{ route('frontend.dokumen') }}" class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <select name="keterangan" id="keteranganFilter" class="form-select">
                            <option value="">-- Semua Keterangan --</option>
                            @foreach ($allKeterangan as $keterangan)
                                <option value="{{ $keterangan }}"
                                    {{ request('keterangan') == $keterangan ? 'selected' : '' }}>
                                    {{ $keterangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="search" id="searchInput" class="form-control"
                            placeholder="Cari nama atau keterangan..." value="{{ request('search') }}">
                    </div>
                </form>

                <div class="table-responsive">
                    {{ $dokumen->links() }}
                    <table id="dokumenTable" class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th style="width: 10%;">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dokumen as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->nama_dok }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    <td>
                                        @if ($value->file)
                                            <a href="{{ route('download.dokumen', $value->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">Download</a>
                                        @else
                                            <em>Belum ada file</em>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data dokumen</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const keteranganSelect = document.getElementById('keteranganFilter');
            const filterForm = document.getElementById('filterForm');

            let debounceTimer;

            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    const keyword = searchInput.value.trim();

                    // hanya submit kalau kosong (clear pencarian) atau minimal 2 huruf
                    if (keyword.length === 0 || keyword.length >= 2) {
                        filterForm.submit();
                    }
                }, 800); // delay 800ms biar gak terlalu cepat submit
            });

            keteranganSelect.addEventListener('change', function() {
                filterForm.submit(); // langsung submit saat dropdown dipilih
            });
        });
    </script>
@endpush
