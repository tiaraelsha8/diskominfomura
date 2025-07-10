<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PengumumanController extends Controller
{
    public function index()
    {
        $response = Http::get('https://pengumuman.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=4');

        if (!$response->successful()) {
            return view('frontend/pengumuman.index', ['pengumuman' => []]);
        }

        $posts = $response->json();

        $pengumuman = collect($posts)->map(function ($post) {
            return [
                'title' => $post['title']['rendered'],
                'link' => $post['link'],
                'excerpt' => strip_tags($post['excerpt']['rendered']),
                'date' => \Carbon\Carbon::parse($post['date'])->format('d M Y'),
                'image' => $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? 'https://via.placeholder.com/600x300?text=No+Image',
            ];
        });
        
        $pengumumans = Pengumuman::latest()->get();
        return view('frontend/pengumuman.index', compact('pengumuman','pengumumans'));
    }
}
