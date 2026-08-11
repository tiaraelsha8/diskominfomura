@extends('frontend.layout.app')

@section('content')
    <style>
        :root {
            --pub-blue: #0d6efd;
            --pub-blue-dark: #0b5ed7;
            --pub-text: #1f2937;
            --pub-muted: #6b7280;
            --pub-bg: #f4f6f8;
            --pub-border: #e5e7eb;
            --clay-orange: #e8631c;
            --clay-orange-dark: #c85416;
        }

        .stat-page {
            background: var(--pub-bg);
            padding: 24px 0 60px;
        }

        .stat-breadcrumb {
            font-size: 0.9rem;
            color: var(--pub-muted);
            margin-bottom: 20px;
        }

        .stat-breadcrumb a {
            color: var(--pub-blue);
            text-decoration: none;
        }

        .stat-breadcrumb a:hover {
            text-decoration: underline;
        }

        .stat-breadcrumb .sep {
            margin: 0 6px;
            color: #c1c7cf;
        }

        .stat-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--pub-text);
            margin-bottom: 12px;
        }

        .stat-header p {
            color: var(--pub-muted);
            font-size: 1rem;
            line-height: 1.6;
            max-width: 900px;
            margin-bottom: 28px;
        }

        /* ---------- 4 Kartu Ringkasan ---------- */
        .stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 10px;
            padding: 18px;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .stat-card--total::before {
            background: var(--pub-blue);
        }

        .stat-card--laki::before {
            background: #0f9d78;
        }

        .stat-card--perempuan::before {
            background: #e0577e;
        }

        .stat-card--kk::before {
            background: #d9a441;
        }

        .stat-card-icon {
            flex-shrink: 0;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card--total .stat-card-icon {
            background: rgba(13, 110, 253, 0.1);
            color: var(--pub-blue);
        }

        .stat-card--laki .stat-card-icon {
            background: rgba(15, 157, 120, 0.1);
            color: #0f9d78;
        }

        .stat-card--perempuan .stat-card-icon {
            background: rgba(224, 87, 126, 0.1);
            color: #e0577e;
        }

        .stat-card--kk .stat-card-icon {
            background: rgba(217, 164, 65, 0.12);
            color: #b3831f;
        }

        .stat-card-label {
            font-size: 0.8rem;
            color: var(--pub-muted);
            font-weight: 600;
            margin-bottom: 2px;
        }

        .stat-card-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--pub-text);
            line-height: 1.1;
        }

        .stat-card-value span {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--pub-muted);
            margin-left: 2px;
        }

        /* ---------- Layout: sidebar + content ---------- */
        .stat-layout {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .stat-sidebar {
            flex: 0 0 270px;
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 10px;
            padding: 16px;
            position: sticky;
            top: 20px;
        }

        .stat-sidebar-heading {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--pub-text);
            padding-bottom: 12px;
            margin-bottom: 10px;
            border-bottom: 1px solid var(--pub-border);
        }

        .stat-category {
            margin-bottom: 4px;
        }

        .stat-category-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            border: none;
            padding: 10px 10px;
            border-radius: 8px;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--pub-text);
            cursor: pointer;
            text-align: left;
            transition: background 0.15s ease;
        }

        .stat-category-btn:hover {
            background: rgba(232, 99, 28, 0.08);
        }

        .stat-category.is-open .stat-category-btn {
            background: rgba(232, 99, 28, 0.1);
            color: var(--clay-orange);
        }

        .stat-chevron {
            flex-shrink: 0;
            color: var(--pub-muted);
            transition: transform 0.2s ease;
        }

        .stat-category.is-open .stat-chevron {
            transform: rotate(90deg);
            color: var(--clay-orange);
        }

        .stat-subcategory-list {
            list-style: none;
            margin: 2px 0 10px;
            padding: 0 0 0 14px;
            display: none;
            position: relative;
        }

        .stat-category.is-open .stat-subcategory-list {
            display: block;
        }

        .stat-subcategory-list::before {
            content: '';
            position: absolute;
            left: 4px;
            top: 4px;
            bottom: 8px;
            width: 2px;
            background: var(--pub-border);
            border-radius: 2px;
        }

        .stat-subcategory-list li {
            position: relative;
            margin-bottom: 2px;
        }

        .stat-subcategory-btn {
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            padding: 8px 10px;
            border-radius: 7px;
            font-size: 0.87rem;
            color: var(--pub-muted);
            cursor: pointer;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .stat-subcategory-btn:hover {
            background: rgba(232, 99, 28, 0.08);
            color: var(--pub-text);
        }

        .stat-subcategory-btn.is-active {
            background: var(--clay-orange);
            color: #fff;
            font-weight: 600;
        }

        /* ---------- Panel tabel ---------- */
        .stat-content {
            flex: 1;
            min-width: 0;
            background: #fff;
            border: 1px solid var(--pub-border);
            border-radius: 10px;
            padding: 22px;
        }

        .stat-panel-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--pub-border);
        }

        .stat-panel-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--pub-text);
            margin: 0;
        }

        .stat-panel-caption {
            font-size: 0.82rem;
            color: var(--pub-muted);
        }

        .stat-table {
            width: 100%;
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .stat-table thead th {
            background: #f8f9fb;
            color: var(--pub-text);
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            text-align: center;
            vertical-align: middle;
            border-bottom: 2px solid var(--pub-border);
        }

        .stat-table tbody td {
            text-align: center;
            vertical-align: middle;
            color: var(--pub-text);
        }

        .stat-table tbody tr:hover td {
            background: rgba(13, 110, 253, 0.04);
        }

        .stat-table tfoot td {
            font-weight: 700;
            text-align: center;
            background: #f8f9fb;
            border-top: 2px solid var(--pub-border);
        }

        .stat-empty {
            text-align: center;
            padding: 40px 10px;
            color: var(--pub-muted);
        }

        /* ---------- Pie Chart ---------- */
        .stat-chart-wrap {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--pub-border);
        }

        .stat-chart-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--pub-text);
            margin-bottom: 6px;
        }

        .stat-chart {
            width: 100%;
            height: 420px;
        }

        @media (max-width: 860px) {
            .stat-layout {
                flex-direction: column;
            }

            .stat-sidebar {
                flex: 1 1 auto;
                width: 100%;
                position: static;
            }
        }

        .stat-view-tabs {
            display: inline-flex;
            gap: 4px;
            margin-bottom: 18px;
            background: #e9edf2;
            border-radius: 12px;
            padding: 4px;
            border: none;
        }

        .stat-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: transparent;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 9px 22px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #8a96a3;
            border-radius: 9px;
            border-bottom: none;
            transition: color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-view-btn:hover {
            color: #003366;
        }

        .stat-view-btn.active {
            color: #003366;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
            border-bottom: none;
        }


        .stat-view-pane {
            display: none;
        }

        .stat-view-pane.active {
            display: block;
        }

        .galeri-head {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 32px;
        }

        .galeri-head .gl-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(30, 73, 116, 0.08);
            color: var(--gl-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .galeri-head h2 {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--gl-navy);
            margin: 0;
        }

        .galeri-head p {
            margin: 2px 0 0;
            color: var(--gl-muted);
            font-size: 0.9rem;
        }
    </style>
    <section class="pt-5 pb-5 mt-5">
        <div class="stat-page container">

            <div class="galeri-head">
                <span class="gl-icon"><i class="bi bi-bar-chart-line"></i></span>
                <div>
                    <h2>Data Statistik</h2>
                    <p>Rangkuman data kependudukan, pendidikan, dan ketenagakerjaan warga Kelurahan Puruk Cahu Seberang</p>
                </div>
            </div>

            {{-- 4 Kartu Ringkasan (partial) --}}
            @include('frontend.statistik.partials.cards')

            {{-- Sidebar accordion + Tabel (partial) --}}
            <div class="stat-layout">
                <aside class="stat-sidebar-wrap">
                    @include('frontend.statistik.partials.sidebar')
                </aside>

                <section class="stat-content">
                    @include('frontend.statistik.partials.tables')
                </section>
            </div>

        </div>
    </section>

    {{-- Highcharts (CDN) --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        // Palet warna default Highcharts (biru, oranye, pink, teal, hijau, mint) — mendekati referensi gambar
        const statChartInstances = {};

        function statRenderChart(key) {
            const data = (window.statChartData && window.statChartData[key]) || [];
            if (!data.length) return;

            statChartInstances[key] = Highcharts.chart('chart-' + key, {
                chart: {
                    type: 'pie',
                    backgroundColor: '#ffffff',
                    style: {
                        fontFamily: 'inherit'
                    },
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: null
                },
                tooltip: {
                    pointFormat: '<b>{point.y} jiwa</b> ({point.percentage:.1f}%)'
                },
                accessibility: {
                    point: {
                        valueSuffix: ' jiwa'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        innerSize: 100,
                        depth: 45,
                        borderWidth: 1,
                        borderColor: '#ffffff',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>',
                            style: {
                                fontSize: '0.78rem',
                                fontWeight: '600',
                                textOutline: 'none',
                                color: '#1f2937'
                            },
                            connectorWidth: 1,
                            connectorColor: '#9aa5b1',
                            distance: 24
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Jumlah',
                    data: data
                }]
            });
        }

        function statToggleCategory(btn) {
            const category = btn.closest('.stat-category');
            const isOpen = category.classList.contains('is-open');

            document.querySelectorAll('.stat-category').forEach(c => c.classList.remove('is-open'));

            if (!isOpen) {
                category.classList.add('is-open');
            }
        }

        function statShowTable(btn) {
            const target = btn.getAttribute('data-target');

            document.querySelectorAll('.stat-subcategory-btn').forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');

            document.querySelectorAll('.stat-table-block').forEach(panel => {
                panel.style.display = panel.getAttribute('data-panel') === target ? 'block' : 'none';
            });

            // Render chart baru sekali saja (lazy), atau reflow kalau sudah pernah dibuat
            if (statChartInstances[target]) {
                statChartInstances[target].reflow();
            } else {
                statRenderChart(target);
            }
        }

        // Render chart untuk panel pertama yang sudah tampil sejak awal (Rentang Umur)
        document.addEventListener('DOMContentLoaded', function () {
            statRenderChart('rentang-umur');
        });
    </script>
@endsection