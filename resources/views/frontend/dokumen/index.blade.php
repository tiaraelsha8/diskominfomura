@extends('frontend.layout.app')

@section('content')
    <!-- ======= Dokumen Start ======= -->
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="case-details__article">
                <h2 class="mb-4 fw-bold">Dokumen</h2>

                {{-- search & filter --}}
                <div class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <select id="keteranganFilter" class="form-select">
                            <option value="">-- Semua Keterangan --</option>
                            @php
                                $keteranganList = $dokumen->pluck('keterangan')->unique();
                            @endphp
                            @foreach ($keteranganList as $keterangan)
                                <option value="{{ $keterangan }}">{{ $keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Cari nama atau keterangan...">
                    </div>
                </div>

                <div class="table-responsive">
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
                                            <a href="{{ route('dokumen.download', $value->id) }}" target="_blank"
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
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('keteranganFilter');
        const table = document.getElementById('dokumenTable');
        const rows = table.querySelectorAll('tbody tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedKeterangan = filterSelect.value.toLowerCase();

            rows.forEach(row => {
                const nama = row.children[1]?.textContent.toLowerCase() || '';
                const keterangan = row.children[2]?.textContent.toLowerCase() || '';

                const matchesSearch = nama.includes(searchTerm) || keterangan.includes(searchTerm);
                const matchesFilter = !selectedKeterangan || keterangan === selectedKeterangan;

                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('keyup', filterTable);
        filterSelect.addEventListener('change', filterTable);
    });
</script>
@endpush
