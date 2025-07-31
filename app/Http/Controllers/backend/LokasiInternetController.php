<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Imports\LokasiImport;
use Illuminate\Http\Request;

use App\Models\Lokasi;
use Maatwebsite\Excel\Facades\Excel;

class LokasiInternetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('backend.lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        Lokasi::create($request->all());
        return redirect()->route('lokasi.index')->with('success', 'Data berhasil disimpan.');
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
        $lokasi = Lokasi::findOrFail($id);
        return view('backend.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_lokasi' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        //get by ID
        $lokasi = Lokasi::findOrFail($id);

        //update 
        $lokasi->update($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $lokasi = Lokasi::findOrFail($id);

        //delete 
        $lokasi->delete();

        //redirect to index
        return redirect()->route('lokasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function import(Request $request)
    {

        //validate form
        $request->validate([
            'file' => 'required|max:2048'
        ]);

        Excel::import(new LokasiImport, $request->file('file'));
        
        //redirect to index
        return redirect()->route('lokasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
