<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Database\QueryException;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('backend.jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'nama_jabatan' => 'required|unique:jabatans,nama_jabatan'
        ]);

        //create
        Jabatan::create($request->all());


        //redirect to index
        return redirect()->route('jabatan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $jabatans = Jabatan::findOrFail($id);
        return view('backend.jabatan.edit', compact('jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama_jabatan' => 'required|unique:jabatans,nama_jabatan,' .$id,
        ]);

        //get product by ID
        $jabatans = Jabatan::findOrFail($id);
        
        //update 
        $jabatans->update($request->all());

        //redirect to index
        return redirect()->route('jabatan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            
         //get by ID
         $jabatans = Jabatan::findOrFail($id);

         //delete 
         $jabatans->delete();
 
         //redirect to index
         return redirect()->route('jabatan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (QueryException $e) {
            // Jika gagal karena masih dipakai (foreign key restrict)
            return redirect()->route('jabatan.index')->with(['error' => 'Tidak bisa menghapus! Jabatan masih digunakan oleh pegawai.']);
        }
    }
}
