<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenfrontController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::paginate(3);
        return view('frontend.dokumen.index',compact('dokumen'));
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id); // pastikan modelnya sesuai

        $filename = $dokumen->file;
        $path = storage_path('app/public/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $dokumen->file . '"'
        ]);
    }
    

}
