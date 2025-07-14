<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\Berita;
use App\Models\pengumuman;
use App\Models\Galeri;
use App\Models\Video;
use App\Models\Layanan;
use App\Models\Dokumen;
use App\Models\Kontak;
use App\Models\Lokasi;

class DashboardController extends Controller
{
    public function index()
    {

        $jumlahJabatan = Jabatan::count();
        $jumlahBidang = Bidang::count();
        $jumlahPegawai = Pegawai::count();
        $jumlahBerita = Berita::count();
        $jumlahPengumuman = Pengumuman::count();
        $jumlahGaleri = Galeri::count();
        $jumlahVideo = Video::count();
        $jumlahLayanan = Layanan::count();
        $jumlahDokumen = Dokumen::count();
        $jumlahPeta = Lokasi::count();

        return view('backend.dashboard', [
        'jumlahJabatan' => $jumlahJabatan,
        'jumlahBidang' => $jumlahBidang,
        'jumlahPegawai' => $jumlahPegawai,
        'jumlahBerita' => $jumlahBerita,
        'jumlahPengumuman' => $jumlahPengumuman,
        'jumlahGaleri' => $jumlahGaleri,
        'jumlahVideo' => $jumlahVideo,
        'jumlahLayanan' => $jumlahLayanan,
        'jumlahDokumen' => $jumlahDokumen,
        'jumlahPeta' => $jumlahPeta,
        ]);
    }
}
