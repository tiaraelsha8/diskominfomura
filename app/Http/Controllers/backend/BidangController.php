<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidang;
use Illuminate\Database\QueryException;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangs = Bidang::all();
        return view('backend.bidang.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_bidang' => 'required|unique:bidangs,nama_bidang'
        ]);

        //create
        Bidang::create($request->all());


        //redirect to index
        return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $bidangs = Bidang::findOrFail($id);
        return view('backend.bidang.edit', compact('bidangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_bidang' => 'required|unique:bidangs,nama_bidang,' .$id,
        ]);

        //get product by ID
        $bidangs = Bidang::findOrFail($id);
        
        //update 
        $bidangs->update($request->all());

        //redirect to index
        return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data
            $bidangs = Bidang::findOrFail($id);
    
            // Coba hapus
            $bidangs->delete();
    
            // Jika berhasil
            return redirect()->route('bidang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (QueryException $e) {
            // Jika gagal karena masih dipakai (foreign key restrict)
            return redirect()->route('bidang.index')->with(['error' => 'Tidak bisa menghapus! Bidang masih digunakan oleh pegawai.']);
        }
    }
}
