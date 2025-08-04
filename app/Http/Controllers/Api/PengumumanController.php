<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengumumanResource;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        //get all Pengumuman
        $pengumuman = Pengumuman::latest()->paginate(5);

        //return collection of berita as a resource
        return new PengumumanResource(true, 'List Data Pengumuman', $pengumuman);
    }
}
