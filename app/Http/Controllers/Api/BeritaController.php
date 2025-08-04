<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        //get all Berita
        $berita = Berita::latest()->paginate(5);

        //return collection of berita as a resource
        return new BeritaResource(true, 'List Data Berita', $berita);
    }
}
