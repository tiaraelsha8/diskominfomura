<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenfrontController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::all();
        return view('frontend.dokumen.index',compact('dokumen'));
    }

}
