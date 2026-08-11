<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Infografis;
use Illuminate\Support\Facades\Storage;
use File;

class InfografisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infografis = Infografis::latest()->get();
        return view('backend.infografis.index', compact('infografis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.infografis.create');
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
        $image->storeAs('infografis', $image->hashName());

        //create product
        Infografis::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('infografis.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $infografis = Infografis::findOrFail($id);

        //render view with product
        return view('backend.infografis.edit', compact('infografis'));
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
        $infografis = Infografis::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('infografis/' . $infografis->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('infografis', $image->hashName());

            //update product with new image
            $infografis->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $infografis->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        //redirect to index
        return redirect()->route('infografis.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $infografis = Infografis::findOrFail($id);

        //delete image
        Storage::delete('infografis/' . $infografis->foto);

        //delete image
        $infografis->delete();

        //redirect to index
        return redirect()->route('infografis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
