<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenfrontController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokumen::query();

        // Ambil semua keterangan unik untuk dropdown filter (dari seluruh data, bukan hanya yg ter-paginate)
        $allKeterangan = Dokumen::select('keterangan')->distinct()->pluck('keterangan');

        // filter by keterangan
        if ($request->filled('keterangan')) {
            $query->where('keterangan', $request->keterangan);
        }

        // search by nama_dok / keterangan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_dok', 'like', "%$search%")->orWhere('keterangan', 'like', "%$search%");
            });
        }

        $dokumen = $query->paginate(3)->withQueryString(); // penting agar paging bawa query

        return view('frontend.dokumen.index', compact('dokumen', 'allKeterangan'));
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
            'Content-Disposition' => 'inline; filename="' . $dokumen->file . '"',
        ]);
    }
}
