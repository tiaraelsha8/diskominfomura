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
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('pengumuman', $image->hashName());

        //create pengumuman
        pengumuman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'foto' => $image->hashName(),
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
                'foto' => $image->hashName(),
            ]);
        } else {
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

        //delete image
        $pengumuman->delete();

        //redirect to index
        return redirect()->route('pengumuman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
