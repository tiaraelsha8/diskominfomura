@extends('frontend.layout.app')

@section('content')
<div class="sd-page">
<style>
.sd-page {
    --sd-navy: #1e4974;
    --sd-navy-deep: #123152;
    --sd-teal: #0f6e66;
    --sd-teal-deep: #0a4f49;
    --sd-gold: #c99a3f;
    --sd-gold-deep: #a67c2b;
    --sd-rose: #a8593f;
    --sd-rose-deep: #86432f;
    --sd-bg: #f3f6f5;
    --sd-surface: #ffffff;
    --sd-ink: #16232c;
    --sd-ink-soft: #566672;
    --sd-line: #dfe6e4;
    --sd-radius: 14px;

    background: var(--sd-bg);
    color: var(--sd-ink);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    padding: 2.5rem 1.25rem 4rem;
}

.sd-page * { box-sizing: border-box; }

.sd-page .sd-container {
    max-width: 1180px;
    margin: 0 auto;
}

/* ---------- Header ---------- */
.sd-page .sd-header {
    margin-bottom: 2rem;
}

.sd-page .sd-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--sd-teal-deep);
    background: rgba(15, 110, 102, 0.08);
    padding: 0.3rem 0.7rem;
    border-radius: 999px;
    margin-bottom: 0.9rem;
}

.sd-page .sd-eyebrow::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--sd-teal);
    display: inline-block;
}

.sd-page .sd-title {
    font-family: 'Fraunces', Georgia, serif;
    font-weight: 600;
    font-size: clamp(1.7rem, 3vw, 2.4rem);
    color: var(--sd-navy-deep);
    margin: 0 0 0.5rem;
    line-height: 1.15;
}

.sd-page .sd-subtitle {
    color: var(--sd-ink-soft);
    font-size: 0.98rem;
    max-width: 640px;
    line-height: 1.6;
    margin: 0;
}

/* ---------- Summary Cards ---------- */
.sd-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 2.25rem;
}

@media (max-width: 900px) {
    .sd-cards { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
    .sd-cards { grid-template-columns: 1fr; }
}

.sd-card {
    background: var(--sd-surface);
    border-radius: var(--sd-radius);
    padding: 1.3rem 1.4rem;
    border: 1px solid var(--sd-line);
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.sd-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px -12px rgba(22, 35, 44, 0.18);
}

.sd-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 4px;
}

.sd-card--total::before { background: var(--sd-navy); }
.sd-card--laki::before { background: var(--sd-teal); }
.sd-card--perempuan::before { background: var(--sd-rose); }
.sd-card--kk::before { background: var(--sd-gold); }

.sd-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.9rem;
}

.sd-card-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.sd-card--total .sd-card-icon { background: rgba(30, 73, 116, 0.1); color: var(--sd-navy); }
.sd-card--laki .sd-card-icon { background: rgba(15, 110, 102, 0.1); color: var(--sd-teal); }
.sd-card--perempuan .sd-card-icon { background: rgba(168, 89, 63, 0.1); color: var(--sd-rose); }
.sd-card--kk .sd-card-icon { background: rgba(201, 154, 63, 0.12); color: var(--sd-gold-deep); }

.sd-card-label {
    font-size: 0.78rem;
    color: var(--sd-ink-soft);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.sd-card-value {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 1.9rem;
    font-weight: 600;
    color: var(--sd-ink);
    line-height: 1;
}

.sd-card-unit {
    font-size: 0.85rem;
    color: var(--sd-ink-soft);
    font-weight: 500;
    margin-left: 0.3rem;
}

/* ---------- Layout: accordion + table ---------- */
.sd-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 1.5rem;
    align-items: start;
}

@media (max-width: 860px) {
    .sd-layout { grid-template-columns: 1fr; }
}

/* Accordion (river branch motif) */
.sd-accordion {
    background: var(--sd-surface);
    border: 1px solid var(--sd-line);
    border-radius: var(--sd-radius);
    padding: 1.1rem 1rem;
    position: sticky;
    top: 1.5rem;
}

.sd-accordion-heading {
    font-family: 'Fraunces', serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--sd-navy-deep);
    margin: 0 0 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--sd-line);
}

.sd-category {
    margin-bottom: 0.35rem;
}

.sd-category-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.6rem;
    background: transparent;
    border: none;
    padding: 0.65rem 0.6rem;
    border-radius: 9px;
    font-family: 'Inter', sans-serif;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--sd-ink);
    cursor: pointer;
    text-align: left;
    transition: background 0.15s ease;
}

.sd-category-btn:hover {
    background: rgba(30, 73, 116, 0.06);
}

.sd-category-btn .sd-chevron {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    transition: transform 0.2s ease;
    color: var(--sd-ink-soft);
}

.sd-category.is-open .sd-category-btn .sd-chevron {
    transform: rotate(90deg);
}

.sd-category.is-open .sd-category-btn {
    background: rgba(30, 73, 116, 0.07);
}

/* River branch line for subcategories */
.sd-subcategory-list {
    list-style: none;
    margin: 0.15rem 0 0.6rem 0;
    padding: 0 0 0 1.15rem;
    position: relative;
    display: none;
}

.sd-category.is-open .sd-subcategory-list {
    display: block;
}

.sd-subcategory-list::before {
    content: '';
    position: absolute;
    left: 0.35rem;
    top: 0.2rem;
    bottom: 0.9rem;
    width: 2px;
    background: linear-gradient(to bottom, var(--sd-teal), var(--sd-line));
    border-radius: 2px;
}

.sd-subcategory-item {
    position: relative;
    margin-bottom: 0.15rem;
}

.sd-subcategory-item::before {
    content: '';
    position: absolute;
    left: -0.8rem;
    top: 50%;
    width: 0.6rem;
    height: 2px;
    background: var(--sd-line);
}

.sd-subcategory-btn {
    width: 100%;
    text-align: left;
    background: transparent;
    border: none;
    padding: 0.5rem 0.6rem;
    border-radius: 8px;
    font-size: 0.87rem;
    color: var(--sd-ink-soft);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: background 0.15s ease, color 0.15s ease;
}

.sd-subcategory-btn:hover {
    background: rgba(15, 110, 102, 0.07);
    color: var(--sd-ink);
}

.sd-subcategory-btn.is-active {
    background: var(--sd-teal);
    color: #fff;
    font-weight: 600;
}

.sd-subcategory-btn.is-active::marker,
.sd-subcategory-btn.is-active .sd-dot {
    background: #fff;
}

.sd-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--sd-line);
    flex-shrink: 0;
}

.sd-subcategory-btn.is-active .sd-dot {
    background: #fff;
}

/* ---------- Table panel ---------- */
.sd-panel {
    background: var(--sd-surface);
    border: 1px solid var(--sd-line);
    border-radius: var(--sd-radius);
    padding: 1.6rem 1.6rem 1.8rem;
    min-height: 420px;
}

.sd-panel-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.3rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--sd-line);
}

.sd-panel-title {
    font-family: 'Fraunces', serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--sd-navy-deep);
    margin: 0;
}

.sd-panel-caption {
    font-size: 0.82rem;
    color: var(--sd-ink-soft);
    font-family: 'IBM Plex Mono', monospace;
}

.sd-table-wrap {
    overflow-x: auto;
}

.sd-table {
    display: none;
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.sd-table.is-active {
    display: table;
}

.sd-table thead th {
    background: rgba(30, 73, 116, 0.05);
    color: var(--sd-navy-deep);
    font-weight: 600;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    padding: 0.7rem 0.8rem;
    border-bottom: 2px solid var(--sd-line);
    text-align: center;
}

.sd-table thead th:first-child { text-align: left; }

.sd-table tbody td {
    padding: 0.65rem 0.8rem;
    border-bottom: 1px solid var(--sd-line);
    text-align: center;
    color: var(--sd-ink);
}

.sd-table tbody td.sd-label {
    text-align: left;
    font-weight: 600;
}

.sd-table tbody tr:hover td {
    background: rgba(15, 110, 102, 0.04);
}

.sd-table tbody td.sd-num {
    font-family: 'IBM Plex Mono', monospace;
}

.sd-table tfoot td {
    padding: 0.75rem 0.8rem;
    font-weight: 700;
    font-family: 'IBM Plex Mono', monospace;
    text-align: center;
    background: rgba(30, 73, 116, 0.05);
    color: var(--sd-navy-deep);
    border-top: 2px solid var(--sd-line);
}

.sd-table tfoot td.sd-label { text-align: left; font-family: 'Fraunces', serif; }

.sd-empty {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--sd-ink-soft);
}
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <div class="sd-container">

        <div class="sd-header">
            <span class="sd-eyebrow">Data Terbuka Kelurahan</span>
            <h1 class="sd-title">Statistik Penduduk Puruk Cahu Seberang</h1>
            <p class="sd-subtitle">
                Rangkuman data kependudukan, pendidikan, dan ketenagakerjaan warga
                Kelurahan Puruk Cahu Seberang, disusun berkala oleh perangkat kelurahan.
            </p>
        </div>

        {{-- 4 Kartu Ringkasan --}}
        <div class="sd-cards">
            <div class="sd-card sd-card--total">
                <div class="sd-card-top">
                    <span class="sd-card-label">Jumlah Penduduk</span>
                    <span class="sd-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                </div>
                <div><span class="sd-card-value">{{ number_format($totalPenduduk, 0, ',', '.') }}</span><span class="sd-card-unit">jiwa</span></div>
            </div>

            <div class="sd-card sd-card--laki">
                <div class="sd-card-top">
                    <span class="sd-card-label">Laki-laki</span>
                    <span class="sd-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="14" r="6"/><path d="M14.5 9.5 21 3"/><path d="M16 3h5v5"/></svg>
                    </span>
                </div>
                <div><span class="sd-card-value">{{ number_format($totalLakiLaki, 0, ',', '.') }}</span><span class="sd-card-unit">jiwa</span></div>
            </div>

            <div class="sd-card sd-card--perempuan">
                <div class="sd-card-top">
                    <span class="sd-card-label">Perempuan</span>
                    <span class="sd-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="M12 15v7"/><path d="M9 19h6"/></svg>
                    </span>
                </div>
                <div><span class="sd-card-value">{{ number_format($totalPerempuan, 0, ',', '.') }}</span><span class="sd-card-unit">jiwa</span></div>
            </div>

            <div class="sd-card sd-card--kk">
                <div class="sd-card-top">
                    <span class="sd-card-label">Jumlah KK</span>
                    <span class="sd-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5 12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></svg>
                    </span>
                </div>
                <div><span class="sd-card-value">{{ number_format($jumlahKk, 0, ',', '.') }}</span><span class="sd-card-unit">KK</span></div>
            </div>
        </div>

        {{-- Accordion + Tabel --}}
        <div class="sd-layout">

            <aside class="sd-accordion">
                <h2 class="sd-accordion-heading">Kategori Data</h2>

                <div class="sd-category is-open" data-category="kependudukan">
                    <button type="button" class="sd-category-btn" onclick="sdToggleCategory(this)">
                        Kependudukan
                        <svg class="sd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                    <ul class="sd-subcategory-list">
                        <li class="sd-subcategory-item">
                            <button type="button" class="sd-subcategory-btn" data-target="rentang-umur" onclick="sdShowTable(this)">
                                <span class="sd-dot"></span> Rentang Umur
                            </button>
                        </li>
                        <button type="button" class="sd-subcategory-btn is-active" data-target="penduduk" onclick="sdShowTable(this)">
                                <span class="sd-dot"></span> Penduduk
                            </button>
                        <li class="sd-subcategory-item">
                            <button type="button" class="sd-subcategory-btn" data-target="agama" onclick="sdShowTable(this)">
                                <span class="sd-dot"></span> Agama
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="sd-category" data-category="pendidikan">
                    <button type="button" class="sd-category-btn" onclick="sdToggleCategory(this)">
                        Pendidikan
                        <svg class="sd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                    <ul class="sd-subcategory-list">
                        <li class="sd-subcategory-item">
                            <button type="button" class="sd-subcategory-btn" data-target="ijazah-tertinggi" onclick="sdShowTable(this)">
                                <span class="sd-dot"></span> Ijazah Tertinggi
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="sd-category" data-category="ketenagakerjaan">
                    <button type="button" class="sd-category-btn" onclick="sdToggleCategory(this)">
                        Ketenagakerjaan
                        <svg class="sd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                    <ul class="sd-subcategory-list">
                        <li class="sd-subcategory-item">
                            <button type="button" class="sd-subcategory-btn" data-target="pekerjaan" onclick="sdShowTable(this)">
                                <span class="sd-dot"></span> Pekerjaan
                            </button>
                        </li>
                    </ul>
                </div>
            </aside>

            <section class="sd-panel">

                @php
                    $tables = [
                        'rentang-umur' => ['title' => 'Rentang Umur', 'rows' => $rentangUmurs, 'labelKey' => 'rentang_umur'],
                        'jenis-kelamin' => ['title' => 'Jenis Kelamin', 'rows' => $jenisKelamins, 'labelKey' => 'jenis_kelamin'],
                        'agama' => ['title' => 'Agama', 'rows' => $agamas, 'labelKey' => 'agama'],
                        'ijazah-tertinggi' => ['title' => 'Ijazah Tertinggi', 'rows' => $ijazahTertinggis, 'labelKey' => 'ijazah_tertinggi'],
                        'pekerjaan' => ['title' => 'Pekerjaan', 'rows' => $pekerjaans, 'labelKey' => 'pekerjaan'],
                    ];
                @endphp

                @foreach ($tables as $key => $t)
                    @php
                        $totalJumlah = $t['rows']->sum(fn($r) => $r->laki_laki + $r->perempuan);
                        $totalLaki = $t['rows']->sum('laki_laki');
                        $totalPr = $t['rows']->sum('perempuan');
                    @endphp

                    <div class="sd-table-block" data-panel="{{ $key }}" style="display: {{ $loop->first ? 'block' : 'none' }};">
                        <div class="sd-panel-header">
                            <h3 class="sd-panel-title">{{ $t['title'] }}</h3>
                            <span class="sd-panel-caption">{{ $t['rows']->count() }} kategori data</span>
                        </div>

                        <div class="sd-table-wrap">
                        <table class="sd-table is-active">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle;">No</th>
                                    <th rowspan="2" style="vertical-align: middle;">{{ $t['title'] }}</th>
                                    <th colspan="2">Jumlah</th>
                                    <th colspan="2">Laki-laki</th>
                                    <th colspan="2">Perempuan</th>
                                </tr>
                                <tr>
                                    <th>Jiwa</th><th>%</th>
                                    <th>Jiwa</th><th>%</th>
                                    <th>Jiwa</th><th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($t['rows'] as $i => $row)
                                    @php
                                        $jumlahRow = $row->laki_laki + $row->perempuan;
                                    @endphp
                                    <tr>
                                        <td class="sd-num">{{ $i + 1 }}</td>
                                        <td class="sd-label">{{ $row->{$t['labelKey']} }}</td>
                                        <td class="sd-num">{{ $jumlahRow }}</td>
                                        <td class="sd-num">{{ $totalJumlah > 0 ? number_format($jumlahRow / $totalJumlah * 100, 1) : 0 }}%</td>
                                        <td class="sd-num">{{ $row->laki_laki }}</td>
                                        <td class="sd-num">{{ $totalLaki > 0 ? number_format($row->laki_laki / $totalLaki * 100, 1) : 0 }}%</td>
                                        <td class="sd-num">{{ $row->perempuan }}</td>
                                        <td class="sd-num">{{ $totalPr > 0 ? number_format($row->perempuan / $totalPr * 100, 1) : 0 }}%</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="sd-empty">Belum ada data untuk kategori ini.</td></tr>
                                @endforelse
                            </tbody>
                            @if ($t['rows']->count() > 0)
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="sd-label">Total</td>
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
                @endforeach

            </section>
        </div>
    </div>
</div>

<script>
function sdToggleCategory(btn) {
    const category = btn.closest('.sd-category');
    const isOpen = category.classList.contains('is-open');

    // Tutup semua kategori lain (accordion style: 1 terbuka dalam satu waktu)
    document.querySelectorAll('.sd-page .sd-category').forEach(c => c.classList.remove('is-open'));

    if (!isOpen) {
        category.classList.add('is-open');
    }
}

function sdShowTable(btn) {
    const target = btn.getAttribute('data-target');

    // Update state tombol subkategori aktif
    document.querySelectorAll('.sd-page .sd-subcategory-btn').forEach(b => b.classList.remove('is-active'));
    btn.classList.add('is-active');

    // Tampilkan panel tabel yang sesuai, sembunyikan yang lain
    document.querySelectorAll('.sd-page .sd-table-block').forEach(panel => {
        panel.style.display = panel.getAttribute('data-panel') === target ? 'block' : 'none';
    });
}
</script>

@endsection