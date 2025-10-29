<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Layanan;
use App\Models\Logo;
use App\Models\Profilbidang;
use Illuminate\Http\Request;
use App\Helpers\VisitorCounter;
use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $carousel = Carousel::all();
        $logos = Logo::first();
        $profilbidangs = Profilbidang::all();
        $data = $logos ? $logos->foto : null;
        $statistik = VisitorCounter::count();
        $beritas = Berita::latest()->paginate(2);
        $pengumumanDB = Pengumuman::latest()->paginate(2);

        //Berita API
        $response = Http::get('https://berita.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=2');

        if (!$response->successful()) {
            return view('frontend/berita.index', ['berita' => [],'beritas' => $beritas]);
        }

        $posts = $response->json();

        $beritaAPI = collect($posts)->map(function ($post) {
            return [
                'title' => $post['title']['rendered'],
                'link' => $post['link'],
                'excerpt' => strip_tags($post['excerpt']['rendered']),
                'date' => \Carbon\Carbon::parse($post['date'])->format('d M Y'),
                'image' => $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? 'https://via.placeholder.com/600x300?text=No+Image',
            ];
        });

        //Pengumuman API
        $response2 = Http::get('https://pengumuman.murungrayakab.go.id/wp-json/wp/v2/posts?_embed&per_page=2');

        $pengumumanAPI = [];

        if ($response2->successful()) {
            $posts = $response2->json();

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

        return view('frontend.home', compact('layanans', 'carousel', 'data', 'profilbidangs', 'statistik', 'beritas', 'pengumumanDB', 'beritaAPI', 'pengumumanAPI'));
    }
}
