<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tentang;

class TentangfrontController extends Controller
{
    public function index()
    {
        $tentang = Tentang::first(); 
        return view('frontend.tentang.index', compact('tentang'));
    }
}
