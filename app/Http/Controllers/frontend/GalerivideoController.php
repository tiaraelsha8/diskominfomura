<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class GalerivideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('frontend.video.index', compact('videos'));
    }
}
