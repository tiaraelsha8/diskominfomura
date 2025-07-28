<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profilbidang;
use Illuminate\Support\Facades\Storage;
use File;

class ProfilbidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilbidangs = Profilbidang::latest()->get();
        return view('backend.profilbidang.index', compact('profilbidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.profilbidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_bidang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:png|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('profilbidang', $image->hashName());

        //create product
        Profilbidang::create([
            'nama_bidang' => $request->nama_bidang,
            'deskripsi' => $request->deskripsi,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('profilbidang.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $profilbidangs = Profilbidang::findOrFail($id);

        //render view with product
        return view('backend.profilbidang.edit', compact('profilbidangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_bidang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:png|max:2048',
        ]);

        //get product by ID
        $profilbidangs = Profilbidang::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('profilbidang/' . $profilbidangs->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('profilbidang', $image->hashName());

            //update product with new image
            $profilbidangs->update([
                'nama_bidang' => $request->nama_bidang,
                'deskripsi' => $request->deskripsi,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $profilbidangs->update([
                'nama_bidang' => $request->nama_bidang,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        //redirect to index
        return redirect()->route('profilbidang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $profilbidangs = Profilbidang::findOrFail($id);

        //delete image
        Storage::delete('profilbidang/' . $profilbidangs->foto);

        //delete image
        $profilbidangs->delete();

        //redirect to index
        return redirect()->route('profilbidang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
