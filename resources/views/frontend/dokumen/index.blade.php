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
    // Ketika halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input dan dropdown filter
        const searchInput = document.getElementById('searchInput'); // input teks untuk cari
        const filterSelect = document.getElementById('keteranganFilter'); // select dropdown
        const table = document.getElementById('dokumenTable'); // tabel dokumen
        const rows = table.querySelectorAll('tbody tr'); // semua baris <tr> di <tbody>

        // Fungsi utama untuk melakukan pencarian + filter
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase(); // ambil dan ubah keyword jadi lowercase
            const selectedKeterangan = filterSelect.value.toLowerCase(); // ambil nilai filter (keterangan) lowercase

            // Loop semua baris data
            rows.forEach(row => {
                const nama = row.children[1]?.textContent.toLowerCase() || '';        // ambil kolom ke-2: nama dokumen
                const keterangan = row.children[2]?.textContent.toLowerCase() || ''; // ambil kolom ke-3: keterangan

                // Cek apakah nama/keterangan mengandung keyword pencarian
                const matchesSearch = nama.includes(searchTerm) || keterangan.includes(searchTerm);

                // Cek apakah keterangan sesuai filter (atau tidak dipilih filter)
                const matchesFilter = !selectedKeterangan || keterangan === selectedKeterangan;

                // Tampilkan baris jika cocok keduanya
                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none'; // sembunyikan kalau tidak cocok
                }
            });
        }

        // Jalankan filterTable setiap kali user mengetik atau memilih filter
        searchInput.addEventListener('keyup', filterTable);  // untuk pencarian
        filterSelect.addEventListener('change', filterTable); // untuk dropdown filter
    });
</script>
@endpush
