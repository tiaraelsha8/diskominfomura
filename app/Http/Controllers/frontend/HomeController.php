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
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\ConnectionException;

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
        try {
            // Request dengan timeout, retry, dan header User-Agent
            $response = Http::timeout(20)                    // Tunggu maksimal 20 detik
                ->retry(3, 200)                               // Retry 3x jika gagal, jeda 200ms
                ->withHeaders([                               // Tambah header User-Agent
                    'User-Agent' => 'Mozilla/5.0 (Laravel App)',
                ])
                ->get('https://berita.murungrayakab.go.id/wp-json/wp/v2/posts', [
                    '_embed' => true,
                    'per_page' => 2,
                ]);

            // Cek jika response gagal (status 4xx/5xx)
            if (!$response->successful()) {
                Log::warning("API Berita returned status {$response->status()}");
                $beritaAPI = collect(); // Kembalikan collection kosong
            } else {
                $posts = $response->json();

                // Mapping data dengan null safety yang lebih baik
                $beritaAPI = collect($posts)->map(function ($post) {
                    // Ambil gambar dengan pengecekan berlapis
                    $image = 'https://via.placeholder.com/600x300?text=No+Image';
                    if (!empty($post['_embedded']['wp:featuredmedia']) && is_array($post['_embedded']['wp:featuredmedia'])) {
                        $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? $image;
                    }

                    return [
                        'title' => $post['title']['rendered'] ?? 'Tanpa Judul',
                        'link' => $post['link'] ?? '#',
                        'excerpt' => strip_tags($post['excerpt']['rendered'] ?? ''),
                        'date' => \Carbon\Carbon::parse($post['date'] ?? now())->format('d M Y'),
                        'image' => $image,
                    ];
                });
            }

        } catch (ConnectionException $e) {
            // Tangani error koneksi (cURL error 7, timeout, dll)
            Log::error("Gagal koneksi ke API Berita: " . $e->getMessage());
            $beritaAPI = collect(); // Fallback: data kosong agar aplikasi tetap jalan

        } catch (\Exception $e) {
            // Tangani error lainnya (parsing JSON, Carbon, dll)
            Log::error("Error saat proses API Berita: " . $e->getMessage());
            $beritaAPI = collect();
        }

        // Pengumuman API
        try {
            $response2 = Http::timeout(20)                    // Tunggu maksimal 20 detik
                ->retry(3, 200)                               // Retry 3x jika gagal, jeda 200ms
                ->withHeaders([                               // Tambah header User-Agent
                    'User-Agent' => 'Mozilla/5.0 (Laravel App)',
                ])
                ->get('https://pengumuman.murungrayakab.go.id/wp-json/wp/v2/posts', [
                    '_embed' => true,
                    'per_page' => 2,
                ]);

            $pengumumanAPI = collect(); // Default: collection kosong

            if ($response2->successful()) {
                $posts = $response2->json();

                $pengumumanAPI = collect($posts)->map(function ($post) {
                    // Ambil gambar dengan pengecekan berlapis (null safety)
                    $image = 'https://via.placeholder.com/600x300?text=No+Image';
                    if (!empty($post['_embedded']['wp:featuredmedia']) && is_array($post['_embedded']['wp:featuredmedia'])) {
                        $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? $image;
                    }

                    return [
                        'title' => $post['title']['rendered'] ?? 'Tanpa Judul',
                        'link' => $post['link'] ?? '#',
                        'excerpt' => strip_tags($post['excerpt']['rendered'] ?? ''),
                        'date' => \Carbon\Carbon::parse($post['date'] ?? now())->format('d M Y'),
                        'image' => $image,
                    ];
                });
            } else {
                Log::warning("API Pengumuman returned status {$response2->status()}");
            }

        } catch (ConnectionException $e) {
            // Tangani error koneksi (cURL error 7, timeout, DNS, dll)
            Log::error("Gagal koneksi ke API Pengumuman: " . $e->getMessage());
            $pengumumanAPI = collect(); // Fallback: data kosong

        } catch (\Exception $e) {
            // Tangani error lainnya (parsing JSON, Carbon, dll)
            Log::error("Error saat proses API Pengumuman: " . $e->getMessage());
            $pengumumanAPI = collect();
        }

        return view('frontend.home', compact('layanans', 'carousel', 'data', 'profilbidangs', 'statistik', 'beritas', 'pengumumanDB', 'beritaAPI', 'pengumumanAPI'));
    }
}
