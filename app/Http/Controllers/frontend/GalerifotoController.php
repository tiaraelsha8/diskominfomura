<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GalerifotoController extends Controller
{
    public function index()
    {
        $galeri = Galeri::paginate(3);
        $galeri_all = Galeri::all();
        return view('frontend.galeri.index',compact('galeri','galeri_all'));
    }
}
