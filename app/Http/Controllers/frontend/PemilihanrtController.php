<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pemilihanrt;
use Illuminate\Http\Request;

class PemilihanrtController extends Controller
{
    public function index()
    {
        $pemilihanrts = Pemilihanrt::all();
        return view('frontend.pemilihanrt.index', compact('pemilihanrts'));
    }

    public function pilihrt()
    {
        //get product by ID
        $pemilihanrts = Pemilihanrt::all();

        //render view with product
        return view('frontend.pemilihanrt.pilihrt', compact('pemilihanrts'));
    }

    public function hasilrt()
    {
        //get product by ID
        $pemilihanrts = Pemilihanrt::all();

        //render view with product
        return view('frontend.pemilihanrt.hasilrt', compact('pemilihanrts'));
    }
}
