<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
// use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        $infografis = Infografis::paginate(12);
        $infografis_all = Infografis::all();
        return view('frontend.infografis.index',compact('infografis','infografis_all'));
    }
}
