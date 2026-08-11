<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublikasiController extends Controller
{
    /**
     * Tampilkan daftar publikasi dengan pencarian kata kunci (judul & deskripsi).
     */
    public function index(Request $request)
    {
        $query = Publikasi::query();

        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($sub) use ($keyword) {
                $sub->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        }

        $publikasi = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.publikasi.index', [
            'publikasi' => $publikasi,
            'keyword'   => $request->q,
        ]);
    }

    /**
     * Tampilkan halaman detail satu publikasi.
     */
    public function show(string $slug)
    {
        $publikasi = Publikasi::where('slug', $slug)->firstOrFail();

        $publikasiLainnya = Publikasi::where('id', '!=', $publikasi->id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.publikasi.show', [
            'publikasi' => $publikasi,
            'publikasiLainnya' => $publikasiLainnya,
        ]);
    }

    /**
     * Unduh file lampiran publikasi dan tambah hitungan download.
     */
    public function download(string $slug)
    {
        $publikasi = Publikasi::where('slug', $slug)->firstOrFail();

        $filePath = 'publikasi/' . $publikasi->file_path;

        abort_unless(
            $publikasi->file_path && Storage::disk('public')->exists($filePath),
            404,
            'File tidak ditemukan.'
        );

        $publikasi->increment('download_count');

        $absolutePath = Storage::disk('public')->path($filePath);
        $downloadName = $publikasi->file_original_name ?? basename($publikasi->file_path);

        return response()->download($absolutePath, $downloadName);
    }
}
