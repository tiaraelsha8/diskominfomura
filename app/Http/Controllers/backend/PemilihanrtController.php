<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pemilihanrt;
use Illuminate\Http\Request;

class PemilihanrtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemilihanrts = Pemilihanrt::latest()->get();
        return view('backend.pemilihanrt.index', compact('pemilihanrts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pemilihanrt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_rt' => 'required',
            'link_pemilihan' => 'required',
            'link_hasil' => 'nullable',

        ]);

        //create product
        Pemilihanrt::create([
            'nama_rt' => $request->nama_rt,
            'link_pemilihan' => $request->link_pemilihan,
            'link_hasil' => $request->link_hasil,
        ]);

        //redirect to index
        return redirect()->route('pemilihanrt.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $pemilihanrts = Pemilihanrt::findOrFail($id);

        //render view with product
        return view('backend.pemilihanrt.edit', compact('pemilihanrts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_rt' => 'required',
            'link_pemilihan' => 'required',
            'link_hasil' => 'nullable',

        ]);

        //get product by ID
        $pemilihanrts = Pemilihanrt::findOrFail($id);

        // Siapkan data dasar
        $data = [
            'nama_layanan' => $request->nama_rt,
            'link_pemilihan' => $request->link_pemilihan,
            'link_hasil' => $request->link_hasil,
        ];


        //update product without image
        $pemilihanrts->update($data);

        //redirect to index
        return redirect()->route('pemilihanrt.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $pemilihanrts = Pemilihanrt::findOrFail($id);


        //delete image
        $pemilihanrts->delete();

        //redirect to index
        return redirect()->route('pemilihanrt.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}