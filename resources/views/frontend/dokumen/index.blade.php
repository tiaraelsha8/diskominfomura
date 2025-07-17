@extends('frontend.layout.app')

@section('content')
    <!-- ======= Dokumen Start ======= -->
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="case-details__article">
                <h2 class="mb-4 fw-bold">Dokumen Perencanaan</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
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
                                            <a href="{{ route('dokumen.download', $value->id) }}"
                                                target="_blank">Download</a>
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

                <h2 class="mt-5 mb-4 fw-bold">Dokumen Pelaporan</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;" class="text-center">No</th>
                                <th>Nama</th>
                                <th style="width: 10%;">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Laporan 2025</td>
                                <td><a href="" target="_blank" class="btn btn-sm btn-outline-primary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Laporan 2025</td>
                                <td><a href="" target="_blank" class="btn btn-sm btn-outline-primary">Download</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
