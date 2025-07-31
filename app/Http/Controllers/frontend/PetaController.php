<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class PetaController extends Controller
{
    public function index()
    {
        $lokasi = lokasi::all();
        return view('frontend.peta.index', compact('lokasi'));
    }
}
