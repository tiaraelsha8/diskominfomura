<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Arsipgaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipgaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsipgaleris = Arsipgaleri::latest()->get();
        return view('backend.arsipgaleri.index', compact('arsipgaleris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.arsipgaleri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_galeri' => 'required',
            'foto' => 'image|mimes:png|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $fotoName = null;
        if ($image) {
            $image->storeAs('arsipgaleri', $image->hashName());
            $fotoName = $image->hashName();
        }

        //create Kategori
        Arsipgaleri::create([
            'nama_galeri' => $request->nama_galeri,
            'foto' => $fotoName,
        ]);

        //redirect to index
        return redirect()->route('arsipgaleri.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $arsipgaleris = Arsipgaleri::find($id);
        return view('backend.arsipgaleri.edit', compact('arsipgaleris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_galeri' => 'required|string|max:100',
            'foto' => 'image|mimes:png|max:2048',
        ]);

        //get product by ID
        $arsipgaleris = Arsipgaleri::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('arsipgaleri/' . $arsipgaleris->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('arsipgaleri', $image->hashName());

            //update product with new image
            $arsipgaleris->update([
                'nama_galeri' => $request->nama_galeri,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update without image
            $arsipgaleris->update([
                'nama_galeri' => $request->nama_galeri,
            ]);
        }

        //redirect to index
        return redirect()->route('arsipgaleri.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $arsipgaleris = Arsipgaleri::findOrFail($id);

        //delete image
        Storage::delete('arsipgaleri/' . $arsipgaleris->foto);

        //delete image
        $arsipgaleris->delete();

        //redirect to index
        return redirect()->route('arsipgaleri.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}