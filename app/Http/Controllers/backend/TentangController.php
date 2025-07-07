<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tentang;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentangs = Tentang::all();
        return view('backend.tentang.index', compact('tentangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tentang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Tentang::count() >= 1) {
            return redirect()
                ->route('tentang.index')
                ->with(['error' => 'Data sudah ada. Tidak boleh lebih dari satu.']);
        }

         //validate form
         $request->validate([
            'tentang' => 'required'
        ]);

        //create
        Tentang::create($request->all());


        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $tentangs = Tentang::findOrFail($id);
        return view('backend.tentang.edit', compact('tentangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'tentang' => 'required'
        ]);

        //get product by ID
        $tentangs = Tentang::findOrFail($id);
        
        //update 
        $tentangs->update($request->all());

        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $tentangs = Tentang::findOrFail($id);

        //delete 
        $tentangs->delete();

        //redirect to index
        return redirect()->route('tentang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
