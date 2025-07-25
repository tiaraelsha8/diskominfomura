<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontak = Kontak::latest()->get();
        return view('backend.kontak.index', compact('kontak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kontak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Kontak::count() >= 1) {
            return redirect()
                ->route('kontak.index')
                ->with(['error' => 'Data sudah ada. Tidak boleh lebih dari satu.']);
        }

        //validate form
        $request->validate([
            'lokasi' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        //create
        Kontak::create($request->all());

        //redirect to index
        return redirect()
            ->route('kontak.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
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
        $kontak = Kontak::findOrFail($id);

        //render view with product
        return view('backend.kontak.edit', compact('kontak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'lokasi' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        //get product by ID
        $kontak = kontak::findOrFail($id);

        $kontak->update([
            'lokasi' => $request->lokasi,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        //redirect to index
        return redirect()
            ->route('kontak.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $kontak = Kontak::findOrFail($id);

        //delete
        $kontak->delete();

        //redirect to index
        return redirect()
            ->route('kontak.index')
            ->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
