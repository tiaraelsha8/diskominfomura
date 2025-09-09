@extends('frontend.layout.app')

@section('content')
    <style>
        .case-details__article {
            background: #fff;
            padding: 5rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-top: 85px;
        }

        .case-details__article h2 {
            font-size: 2.4rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: .5rem;
        }

        #filterForm .form-select,
        #filterForm .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            box-shadow: none;
            transition: border-color 0.2s ease;
        }

        #filterForm .form-select:focus,
        #filterForm .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, .2);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #f3f4f6;
            font-weight: 600;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .btn-outline-primary {
            border-radius: 6px;
            font-size: 0.85rem;
            padding: 6px 12px;
            transition: all .2s ease;
        }

        .btn-outline-primary:hover {
            background: #2563eb;
            color: #fff;
        }

        .no-news-text {
            text-align: center;
            padding: 1rem;
            color: #6b7280;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .case-details__article {
                padding: 1.5rem;
                margin-top: 55px;
            }

            .case-details__article h2 {
                font-size: 1.6rem;
                text-align: center;
            }

            #filterForm {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .table {
                display: block;
                width: 100%;
                overflow-x: auto;
                border-radius: 6px;
            }

            .table th,
            .table td {
                padding: 8px;
                font-size: 0.85rem;
                white-space: nowrap;
            }

            .btn-outline-primary {
                font-size: 0.8rem;
                padding: 5px 10px;
                width: 100%;
            }

            .no-news-text {
                font-size: 0.9rem;
                padding: 0.8rem;
            }
        }
    </style>
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
                                            <em style="text-align:center; color:black;">Belum ada file</em>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <p class="no-news-text">Belum ada data dokumen</p>
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
