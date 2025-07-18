<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakfrontController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('frontend.kontak.index', compact('kontak')); 
    }

}
