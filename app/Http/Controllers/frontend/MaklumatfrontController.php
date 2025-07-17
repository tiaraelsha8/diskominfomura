<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maklumat;

class MaklumatfrontController extends Controller
{
    public function index()
    {
        $maklumat = Maklumat::first(); 
        return view('frontend.maklumat.index', compact('maklumat'));
    }
}
