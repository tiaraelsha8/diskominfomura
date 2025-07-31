<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Layanan;
use App\Models\Logo;
use App\Models\Profilbidang;
use Illuminate\Http\Request;
use App\Helpers\VisitorCounter;

class HomeController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $carousel = Carousel::all();
        $logos = Logo::first();
        $profilbidangs = Profilbidang::all();
        $data = $logos ? $logos->foto : null;
        $statistik = VisitorCounter::count();

        return view('frontend.home', compact('layanans', 'carousel', 'data', 'profilbidangs', 'statistik'));
    }
}
