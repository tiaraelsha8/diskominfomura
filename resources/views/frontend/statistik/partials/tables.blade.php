{{-- resources/views/frontend/statistik/partials/tables.blade.php --}}

@php
    $statTables = [
        'rentang-umur' => [
            'title' => 'Rentang Umur',
            'rows' => $rentangUmurs,
            'labelKey' => 'rentang_umur',
            'labelHeader' => 'Rentang Umur',
        ],
        'penduduk' => [
            'title' => 'Penduduk',
            'rows' => $jenisKelaminRts, // ganti dari $jenisKelamins
            'labelKey' => 'rt', // ganti dari 'jenis_kelamin'
            'labelHeader' => 'RT', // ganti dari 'Kelompok'
        ],
        'agama' => ['title' => 'Agama', 'rows' => $agamas, 'labelKey' => 'agama', 'labelHeader' => 'Agama'],
        'ijazah-tertinggi' => [
            'title' => 'Ijazah Tertinggi',
            'rows' => $ijazahTertinggis,
            'labelKey' => 'ijazah_tertinggi',
            'labelHeader' => 'Ijazah Tertinggi',
        ],
        'pekerjaan' => [
            'title' => 'Pekerjaan',
            'rows' => $pekerjaans,
            'labelKey' => 'pekerjaan',
            'labelHeader' => 'Pekerjaan',
        ],
    ];

    // Data untuk pie chart tiap indikator: [{name: 'Islam', y: 600}, ...]
    $statChartData = [];
    foreach ($statTables as $key => $t) {
        $statChartData[$key] = $t['rows']
            ->map(function ($row) use ($t) {
                return [
                    'name' => $row->{$t['labelKey']},
                    'y' => $row->laki_laki + $row->perempuan,
                ];
            })
            ->values();
    }
@endphp

<script>
    window.statChartData = @json($statChartData);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.stat-table-block').forEach(function(block) {
            const buttons = block.querySelectorAll('.stat-view-btn');
            const panes = block.querySelectorAll('.stat-view-pane');

            buttons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const targetId = btn.getAttribute('data-target');

                    buttons.forEach(b => b.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));

                    btn.classList.add('active');
                    document.getElementById(targetId).classList.add('active');

                    // Trigger reflow chart Highcharts kalau baru pertama kali dibuka
                    // (chart yang dirender saat container display:none ukurannya kacau)
                    if (btn.dataset.view === 'grafik' && typeof Highcharts !==
                        'undefined') {
                        Highcharts.charts.forEach(function(chart) {
                            if (chart && chart.renderTo && block.contains(chart
                                    .renderTo)) {
                                chart.reflow();
                            }
                        });
                    }
                });
            });
        });
    });
</script>

@foreach ($statTables as $key => $t)
    @php
        $totalJumlah = $t['rows']->sum(fn($r) => $r->laki_laki + $r->perempuan);
        $totalLaki = $t['rows']->sum('laki_laki');
        $totalPr = $t['rows']->sum('perempuan');
    @endphp

    <div class="stat-table-block" data-panel="{{ $key }}" style="{{ $loop->first ? '' : 'display:none;' }}">
        <div class="stat-panel-header">
            <div>
                <h2 class="stat-panel-title">{{ $t['title'] }}</h2>
                <span class="stat-panel-caption">{{ $t['rows']->count() }} kategori data</span>
            </div>

            <div class="stat-view-tabs">
                <button type="button" class="stat-view-btn active" data-view="tabel"
                    data-target="view-tabel-{{ $key }}">
                    <i class="bi bi-table"></i> Tabel
                </button>
                <button type="button" class="stat-view-btn" data-view="grafik"
                    data-target="view-grafik-{{ $key }}">
                    <i class="bi bi-pie-chart"></i> Grafik
                </button>
            </div>
        </div>

        {{-- Sub-tab: Tabel / Grafik --}}


        {{-- View: Tabel (default aktif) --}}
        <div class="stat-view-pane active" id="view-tabel-{{ $key }}">
            <div class="table-responsive">
                <table class="table stat-table">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle text-start">{{ $t['labelHeader'] }}</th>
                            <th colspan="2">Jumlah</th>
                            <th colspan="2">Laki-laki</th>
                            <th colspan="2">Perempuan</th>
                        </tr>
                        <tr>
                            <th>Jiwa</th>
                            <th>%</th>
                            <th>Jiwa</th>
                            <th>%</th>
                            <th>Jiwa</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($t['rows'] as $i => $row)
                            @php $jumlahRow = $row->laki_laki + $row->perempuan; @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="text-start fw-semibold">{{ $row->{$t['labelKey']} }}</td>
                                <td>{{ $jumlahRow }}</td>
                                <td>{{ $totalJumlah > 0 ? number_format(($jumlahRow / $totalJumlah) * 100, 1) : 0 }}%
                                </td>
                                <td>{{ $row->laki_laki }}</td>
                                <td>{{ $totalLaki > 0 ? number_format(($row->laki_laki / $totalLaki) * 100, 1) : 0 }}%
                                </td>
                                <td>{{ $row->perempuan }}</td>
                                <td>{{ $totalPr > 0 ? number_format(($row->perempuan / $totalPr) * 100, 1) : 0 }}%</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="stat-empty">Belum ada data untuk kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($t['rows']->count() > 0)
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-start">Total</td>
                                <td>{{ $totalJumlah }}</td>
                                <td>100%</td>
                                <td>{{ $totalLaki }}</td>
                                <td>100%</td>
                                <td>{{ $totalPr }}</td>
                                <td>100%</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- View: Grafik --}}
        @if ($t['rows']->count() > 0)
            <div class="stat-view-pane" id="view-grafik-{{ $key }}">
                <div class="stat-chart-wrap">
                    <h3 class="stat-chart-title">Proporsi {{ $t['title'] }}</h3>
                    <div id="chart-{{ $key }}" class="stat-chart"></div>
                </div>
            </div>
        @endif
    </div>
@endforeach
