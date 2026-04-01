<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Arsipgaleri;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GalerifotoController extends Controller
{
    public function index()
    {
        $galeri = Galeri::paginate(12);
        $galeri_all = Galeri::all();
        $arsipgaleris = Arsipgaleri::all();
        return view('frontend.galeri.index', compact('galeri', 'galeri_all', 'arsipgaleris'));
    }

    public function read(string $id)
    {
        //get by ID
        $galeris = Galeri::get();
        $arsipgaleris = Arsipgaleri::with('galeris')->findOrFail($id);
        //dd($kategoris->layanans);

        return view('frontend.galeri.show', compact('arsipgaleris'));
    }
}
