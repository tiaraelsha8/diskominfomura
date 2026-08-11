<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\StatistikAgama;
use App\Models\StatistikIjazah;
use App\Models\StatistikPekerjaan;
// use App\Models\Penduduk;
use App\Models\StatistikRentangUmur;
use App\Models\StatistikJenisKelamin;

class StatistikController extends Controller
{
    public function index()
    {
        $rentangUmurs     = StatistikRentangUmur::orderBy('id')->get();
        $jenisKelamins    = StatistikJenisKelamin::orderBy('id')->get();
        $agamas           = StatistikAgama::orderBy('id')->get();
        $ijazahTertinggis = StatistikIjazah::orderBy('id')->get();
        $pekerjaans       = StatistikPekerjaan::orderBy('id')->get();

        // Sumber tunggal untuk kartu ringkasan & tabel Penduduk
        $penduduk = StatistikJenisKelamin::first();

        $totalLakiLaki  = $penduduk->laki_laki ?? 0;
        $totalPerempuan = $penduduk->perempuan ?? 0;
        $totalPenduduk  = $totalLakiLaki + $totalPerempuan;
        $jumlahKk       = $jenisKelamins->sum('jumlah_kk');

        return view('frontend.statistik.index', compact(
              'rentangUmurs',
            'jenisKelamins',
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