<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tentang;
use Illuminate\Support\Facades\File;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentangs = Tentang::all();
        return view('backend.tentang.index', compact('tentangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tentang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Tentang::count() >= 1) {
            return redirect()
                ->route('tentang.index')
                ->with(['error' => 'Data sudah ada. Tidak boleh lebih dari satu.']);
        }

         //validate form
         $request->validate([
            'tentang' => 'required'
        ]);

        // Ambil konten dan folder_id dari request
        $deskripsi = $request->tentang;
        preg_match('/storage\/tentang\/foto\/([^\/]+)\//', $deskripsi, $matches);
        $folderId = $matches[1] ?? "";

        $storagePath = public_path('storage/tentang/foto/' . $folderId);

        if ($folderId && File::exists($storagePath)) {
            preg_match_all('/<img [^>]*src="([^"]+)"/', $deskripsi, $matches);

            $imagesInContent = array_map(function ($url) {
                return basename(parse_url($url, PHP_URL_PATH));
            }, $matches[1]);

            $allFiles = File::files($storagePath);

            foreach ($allFiles as $file) {
                $fileName = $file->getFilename();

                if (!in_array($fileName, $imagesInContent)) {
                    File::delete($file->getPathname());
                }
            }

            if (count(File::files($storagePath)) === 0) {
                File::deleteDirectory($storagePath);
            }
        }

        //create
        Tentang::create($request->all());


        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $tentangs = Tentang::findOrFail($id);
        return view('backend.tentang.edit', compact('tentangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'tentang' => 'required'
        ]);

        // Ambil konten dan folder_id dari request
        $deskripsi = $request->tentang;
        preg_match('/storage\/tentang\/foto\/([^\/]+)\//', $deskripsi, $matches);
        $folderId = $matches[1] ?? "";

        $storagePath = public_path('storage/tentang/foto/' . $folderId);

        if ($folderId && File::exists($storagePath)) {
            preg_match_all('/<img [^>]*src="([^"]+)"/', $deskripsi, $matches);

            $imagesInContent = array_map(function ($url) {
                return basename(parse_url($url, PHP_URL_PATH));
            }, $matches[1]);

            $allFiles = File::files($storagePath);

            foreach ($allFiles as $file) {
                $fileName = $file->getFilename();

                if (!in_array($fileName, $imagesInContent)) {
                    File::delete($file->getPathname());
                }
            }

            if (count(File::files($storagePath)) === 0) {
                File::deleteDirectory($storagePath);
            }
        }

        //get product by ID
        $tentangs = Tentang::findOrFail($id);
        
        //update 
        $tentangs->update($request->all());

        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $tentangs = Tentang::findOrFail($id);
        $deskripsi = $tentangs->tentang;

        preg_match('/storage\/tentang\/foto\/([^\/]+)\//', $deskripsi, $matches);

        if (isset($matches[1])) {
            $folderId = $matches[1];
            $folderPath = public_path('storage/tentang/foto/' . $folderId);

            if (File::exists($folderPath)) {
                File::deleteDirectory($folderPath);
            }
        }

        //delete 
        $tentangs->delete();

        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, $allowedExtensions)) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.']
                ]);
            }

            $maxSize = 2 * 1024 * 1024;
            if ($file->getSize() > $maxSize) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'Ukuran foto terlalu besar! Maksimal adalah 2MB.']
                ]);
            }

            $folderId = $request->query('folder_id');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $path = "storage/tentang/foto/" . $folderId;
            $file->move(public_path($path), $fileName);

            return response()->json([
                'uploaded' => 1,
                'url' => asset($path . '/' . $fileName)
            ]);
        }
    }
}
