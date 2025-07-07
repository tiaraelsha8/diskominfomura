<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $response = Http::get('https://berita.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=4');

        if (!$response->successful()) {
            return view('frontend/berita.index', ['berita' => []]);
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
        $beritas = Berita::latest()->get();
        return view('frontend/berita.index', compact('berita','beritas'));
    }


    
}
