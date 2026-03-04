<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Berita;
use Illuminate\Support\Facades\Cache;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(12);
        $response = Http::get('https://berita.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=4');

        if (!$response->successful()) {
            return view('frontend/berita.index', ['berita' => [], 'beritas' => $beritas]);
        }

        $posts = $response->json();

        $berita = collect($posts)->map(function ($post) {
            return [
                'title' => $post['title']['rendered'],
                'link' => $post['link'],
                'excerpt' => strip_tags($post['excerpt']['rendered']),
                'date' => \Carbon\Carbon::parse($post['date'])->format('d M Y'),
                'image' => $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? 'https://via.placeholder.com/600x300?text=No+Image',
            ];
        });

        return view('frontend/berita.index', compact('berita', 'beritas'));
    }

    public function read(string $id)
    {
        //get product by ID
        $beritas = Berita::findOrFail($id);

        // key unik (id + IP)
        $$key = 'berita_' . $beritas->id . '_' . md5(request()->ip() . request()->userAgent());

        // cek biar tidak nambah terus saat refresh
        if (!Cache::has($key)) {
            $beritas->increment('views');
            Cache::put($key, true, now()->addMinutes(30)); // 30 menit
        }

        //render view with product
        return view('frontend.berita.show', compact('beritas'));
    }
}
