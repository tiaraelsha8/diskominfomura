<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Storage;
use File;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = Layanan::latest()->get();
        return view('backend.layanan.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'logo' => 'required|image|mimes:png|max:2048',
            'background' => 'required|image|mimes:jpeg,jpg,png|max:4096',
        ]);

        //upload logo
        $logo = $request->file('logo');
        $logo->storeAs('layanan/logo', $logo->hashName());

        // upload background
        $background = $request->file('background');
        $background->storeAs('layanan/background', $background->hashName());

        //create product
        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'logo' => $logo->hashName(),
            'background' => $background->hashName(),
        ]);

        //redirect to index
        return redirect()->route('layanan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $layanans = Layanan::findOrFail($id);

        //render view with product
        return view('backend.layanan.edit', compact('layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_layanan' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'logo' => 'nullable|image|mimes:png|max:2048',
            'background' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        ]);

        //get product by ID
        $layanans = Layanan::findOrFail($id);

        // Siapkan data dasar
        $data = [
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ];

        //check if image is uploaded
        if ($request->hasFile('logo')) {
            //delete old image
            Storage::delete('layanan/logo/' . $layanans->logo);

            //upload new image
            $logo = $request->file('logo');
            $logo->storeAs('layanan/logo', $logo->hashName());
            $data['logo'] = $logo->hashName();
        }

        if ($request->hasFile('background')) {
            //delete old image
            Storage::delete('layanan/background/' . $layanans->background);

            //upload new image
            $background = $request->file('background');
            $background->storeAs('layanan/background', $background->hashName());
            $data['background'] = $background->hashName();

        }

        //update product without image
        $layanans->update($data);

        //redirect to index
        return redirect()->route('layanan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $layanans = Layanan::findOrFail($id);

        //delete image
        if ($layanans->logo) {
            Storage::delete('layanan/logo/' . $layanans->logo);
        }

        if ($layanans->background) {
            Storage::delete('layanan/background/' . $layanans->background);
        }

        //delete image
        $layanans->delete();

        //redirect to index
        return redirect()->route('layanan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
