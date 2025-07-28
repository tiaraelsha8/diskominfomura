<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        // Ambil dari API WordPress
        $response = Http::get('https://pengumuman.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=4');

        $pengumumanAPI = [];

        if ($response->successful()) {
            $posts = $response->json();

            $pengumumanAPI = collect($posts)->map(function ($post) {
                return [
                    'title' => $post['title']['rendered'],
                    'link' => $post['link'],
                    'excerpt' => strip_tags($post['excerpt']['rendered']),
                    'date' => \Carbon\Carbon::parse($post['date'])->format('d M Y'),
                    'image' => $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? 'https://via.placeholder.com/600x300?text=No+Image',
                ];
            });
        }

        // Ambil dari database lokal
        $pengumumanDB = Pengumuman::latest()->paginate(1);

        return view('frontend.pengumuman.index', compact('pengumumanAPI', 'pengumumanDB'));
    }

    public function show($id)
    {
        $pengumumanDB = Pengumuman::findOrFail($id);

        return view('frontend.pengumuman.show', compact('pengumumanDB'));
    }

    public function download($id)
    {
        $pengumumanDB = Pengumuman::findOrFail($id); // pastikan modelnya sesuai

        $filename = $pengumumanDB->file;
        $path = storage_path('app/public/pengumuman/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $pengumumanDB->file . '"',
        ]);
    }
}
