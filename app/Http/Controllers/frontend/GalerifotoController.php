<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Arsipgaleri;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GalerifotoController extends Controller
{
    public function index()
    {
        $galeri = Galeri::paginate(12);
        $galeri_all = Galeri::all();
        $grupgaleri = Galeri::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
            DB::raw('COUNT(*) as total'),
            DB::raw('MAX(id) as id_terbaru') // ID foto terbaru untuk preview
        )
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc') // Bulan terbaru di atas
            ->get();
        $arsipgaleris = Arsipgaleri::all();
        //dd($grupgaleri);
        return view('frontend.galeri.index', compact('galeri', 'galeri_all', 'arsipgaleris', 'grupgaleri'));
    }

    public function read(string $id)
    {
        //get by ID
        $galeris = Galeri::get();
        $arsipgaleris = Arsipgaleri::with('galeris')->findOrFail($id);
        //dd($kategoris->layanans);

        return view('frontend.galeri.show', compact('arsipgaleris'));
    }

    public function detail($bulan)
    {
        $fotos = Galeri::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$bulan])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.galeri.detail', compact('fotos', 'bulan'));
    }
}
