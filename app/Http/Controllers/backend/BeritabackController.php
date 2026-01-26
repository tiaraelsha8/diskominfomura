<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BeritabackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('backend.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Ambil konten dari request
        $deskripsi = $request->deskripsi;

        // 1. Ambil semua nama file yang ADA di dalam konten (yang akan disimpan)
        preg_match_all('/<img [^>]*src="([^"]+)"/', $deskripsi, $matches);

        // Kita bersihkan URL-nya sehingga hanya menyisakan nama filenya saja (contoh: gambar1.jpg)
        $imagesInContent = array_map(function ($url) {
            return basename(parse_url($url, PHP_URL_PATH));
        }, $matches[1]);

        // 2. Ambil semua file FISIK yang saat ini ada di folder
        $storagePath = public_path('storage/berita/foto');
        $allFiles = File::files($storagePath);

        // 3. Bandingkan: Jika file di folder tidak ada di dalam konten, maka HAPUS
        foreach ($allFiles as $file) {
            $fileName = $file->getFilename();

            if (!in_array($fileName, $imagesInContent)) {
                File::delete($file->getPathname());
            }
        }

        //upload image
        $image = $request->file('foto');
        $image->storeAs('berita', $image->hashName());

        //create berita
        Berita::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get product by ID
        $berita = Berita::findOrFail($id);

        //render view with product
        return view('backend.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Ambil konten dari request
        $deskripsi = $request->deskripsi;

        // 1. Ambil semua nama file yang ADA di dalam konten (yang akan disimpan)
        preg_match_all('/<img [^>]*src="([^"]+)"/', $deskripsi, $matches);

        // Kita bersihkan URL-nya sehingga hanya menyisakan nama filenya saja (contoh: gambar1.jpg)
        $imagesInContent = array_map(function ($url) {
            return basename(parse_url($url, PHP_URL_PATH));
        }, $matches[1]);

        // 2. Ambil semua file FISIK yang saat ini ada di folder
        $storagePath = public_path('storage/berita/foto');
        $allFiles = File::files($storagePath);

        // 3. Bandingkan: Jika file di folder tidak ada di dalam konten, maka HAPUS
        foreach ($allFiles as $file) {
            $fileName = $file->getFilename();

            if (!in_array($fileName, $imagesInContent)) {
                File::delete($file->getPathname());
            }
        }

        //get product by ID
        $berita = berita::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('berita/' . $berita->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('berita', $image->hashName());

            //update product with new image
            $berita->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $berita->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
            ]);
        }

        //redirect to index
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $berita = Berita::findOrFail($id);

        //delete image
        Storage::delete('storage/berita/' . $berita->foto);

        //delete image
        $berita->delete();

        //redirect to index
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Ambil nama file asli
            $originName = $file->getClientOriginalName();

            // Buat nama file unik agar tidak bentrok (misal: 1737250000_berita.jpg)
            $fileName = time() . '_' . $originName;

            // Pindahkan ke folder public/maklumats/foto
            // Laravel akan otomatis mencari folder ini di dalam direktori 'public'
            $file->move(public_path('storage/berita/foto'), $fileName);

            // Buat URL untuk dikembalikan ke CKEditor
            $url = asset('storage/berita/foto/' . $fileName);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'File tidak ditemukan.']]);
    }
}
