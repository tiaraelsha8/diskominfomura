@extends('frontend.layout.app')


@section('content')
    <div class="container">
        @php
            $bulanIndo = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];
            $numBulan = \Carbon\Carbon::createFromFormat('Y-m', $bulan)->format('m');
            $tahun = \Carbon\Carbon::createFromFormat('Y-m', $bulan)->format('Y');
        @endphp

        <h1>Galeri {{ $bulanIndo[$numBulan] }} {{ $tahun }}</h1>
        <a href="{{ route('galeri.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="row">
            @foreach($fotos as $foto)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        @if($foto->foto)
                            <img src="{{ asset('storage/galeri/' . $foto->foto) }}" class="card-img-top" alt="{{ $foto->judul }}"
                                style="height: 150px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $foto->judul }}</h6>
                            <p class="card-text small">{{ Str::limit($foto->deskripsi, 50) }}</p>
                            <p class="text-muted small">
                                {{ $foto->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection