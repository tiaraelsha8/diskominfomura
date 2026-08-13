<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\StatistikAgama;
use App\Models\StatistikIjazah;
use App\Models\StatistikPekerjaan;
use App\Models\StatistikRentangUmur;
use App\Models\StatistikJenisKelaminRt;

class StatistikController extends Controller
{
    public function index()
    {
        $rentangUmurs     = StatistikRentangUmur::orderBy('id')->get();
        $agamas           = StatistikAgama::orderBy('id')->get();
        $ijazahTertinggis = StatistikIjazah::orderBy('id')->get();
        $pekerjaans       = StatistikPekerjaan::orderBy('id')->get();

        // Breakdown per RT — sumber tabel & grafik "Penduduk"
        $jenisKelaminRts = StatistikJenisKelaminRt::orderByRaw(
            'CAST(REGEXP_REPLACE(rt, "[^0-9]", "") AS UNSIGNED) ASC'
        )->get();

        // Kartu ringkasan dihitung langsung dari kumulatif RT (bukan dari statistik_jk)
        $totalLakiLaki  = $jenisKelaminRts->sum('laki_laki');
        $totalPerempuan = $jenisKelaminRts->sum('perempuan');
        $totalPenduduk  = $totalLakiLaki + $totalPerempuan;
        $jumlahKk       = $jenisKelaminRts->sum('jumlah_kk');

        return view('frontend.statistik.index', compact(
            'rentangUmurs',
            'jenisKelaminRts',
            'agamas',
            'ijazahTertinggis',
            'pekerjaans',
            'totalPenduduk',
            'totalLakiLaki',
            'totalPerempuan',
            'jumlahKk'
        ));
    }
}