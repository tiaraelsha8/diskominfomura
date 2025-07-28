<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('backend.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pengumuman.create');
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
            'file' => 'required|mimes:pdf|max:5120', //5 mb
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('pengumuman', $image->hashName());

        //upload file
        $file = $request->file('file');
        $file->storeAs('pengumuman/dokumen', $file->hashName());

        //create pengumuman
        pengumuman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'foto' => $image->hashName(),
            'file' => $file->hashName(),
        ]);

        //redirect to index
        return redirect()->route('pengumuman.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $pengumuman = pengumuman::findOrFail($id);

        //render view with product
        return view('backend.pengumuman.edit', compact('pengumuman'));
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
            'file' => 'mimes:pdf|max:5120', //5 mb
        ]);

        //get product by ID
        $pengumuman = pengumuman::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('pengumuman/' . $pengumuman->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('pengumuman', $image->hashName());

            //update product with new image
            $pengumuman->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
                'foto' => $image->hashName(),
            ]);
        }
        elseif ($request->hasFile('file')) {
            //delete old file
            Storage::delete('pengumuman/dokumen/' . $pengumuman->file);

            //upload file
            $file = $request->file('file');
            $file->storeAs('pengumuman/dokumen', $file->hashName());

            //update product with new image
            $pengumuman->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
                'file' => $file->hashName(),
            ]);
        }  
        else {
            //update product without image
            $pengumuman->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
            ]);
        }

        //redirect to index
        return redirect()->route('pengumuman.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $pengumuman = pengumuman::findOrFail($id);

        //delete image
        Storage::delete('pengumuman/' . $pengumuman->foto);
        Storage::delete('pengumuman/dokumen/' . $pengumuman->file);

        //delete image
        $pengumuman->delete();

        //redirect to index
        return redirect()->route('pengumuman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function download($id)
    {
        $dokumen = Pengumuman::findOrFail($id); // pastikan modelnya sesuai

        $filename = $dokumen->file;
        $path = storage_path('app/public/pengumuman/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $dokumen->file . '"',
        ]);
    }
}
