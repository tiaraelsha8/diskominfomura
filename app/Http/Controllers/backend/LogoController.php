<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logo = Logo::latest()->get();
        return view('backend.logo.index', compact('logo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.logo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Logo::count() >= 1) {
            return redirect()
                ->route('logo.index')
                ->with(['error' => 'Data sudah ada. Tidak boleh lebih dari satu.']);
        }

        //validate form
        $request->validate([
            'judul' => 'required',
            'foto' => 'required|image|mimes:png|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('logo', $image->hashName());

        //create Logo
        Logo::create([
            'judul' => $request->judul,
            'foto' => $image->hashName(),
        ]);

        //redirect to index
        return redirect()->route('logo.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $logo = Logo::findOrFail($id);

        //render view with product
        return view('backend.logo.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get product by ID
        $logo = logo::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('logo/' . $logo->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('logo', $image->hashName());

            //update product with new image
            $logo->update([
                'judul' => $request->judul,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update product without image
            $logo->update([
                'judul' => $request->judul,
            ]);
        }

        //redirect to index
        return redirect()->route('logo.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $logo = Logo::findOrFail($id);

        //delete image
        Storage::delete('logo/' . $logo->foto);

        //delete image
        $logo->delete();

        //redirect to index
        return redirect()->route('logo.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
