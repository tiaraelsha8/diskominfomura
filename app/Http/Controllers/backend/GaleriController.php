<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use File;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('backend.galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.galeri.create');
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
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('galeri', $image->hashName());

        //create product
        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('galeri.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $galeri = Galeri::findOrFail($id);

        //render view with product
        return view('backend.galeri.edit', compact('galeri'));
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
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get product by ID
        $galeri = Galeri::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('galeri/' . $galeri->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('galeri', $image->hashName());

            //update product with new image
            $galeri->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $galeri->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        //redirect to index
        return redirect()->route('galeri.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $galeri = Galeri::findOrFail($id);

        //delete image
        Storage::delete('galeri/' . $galeri->foto);

        //delete image
        $galeri->delete();

        //redirect to index
        return redirect()->route('galeri.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
