<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maklumat;

class MaklumatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maklumats = Maklumat::all();
        return view('backend.maklumat.index', compact('maklumats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.maklumat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Maklumat::count() >= 1) {
            return redirect()
                ->route('maklumat.index')
                ->with(['error' => 'Data sudah ada. Tidak boleh lebih dari satu.']);
        }

         //validate form
         $request->validate([
            'maklumat' => 'required'
        ]);

        //create
        Maklumat::create($request->all());


        //redirect to index
        return redirect()->route('maklumat.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $maklumats = Maklumat::findOrFail($id);
        return view('backend.maklumat.edit', compact('maklumats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'maklumat' => 'required'
        ]);

        //get product by ID
        $maklumats = Maklumat::findOrFail($id);
        
        //update 
        $maklumats->update($request->all());

        //redirect to index
        return redirect()->route('maklumat.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $maklumats = Maklumat::findOrFail($id);

        //delete 
        $maklumats->delete();

        //redirect to index
        return redirect()->route('maklumat.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
