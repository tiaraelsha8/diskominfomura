<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Bidang;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Storage;
use File;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::with(['bidang', 'jabatan'])->get();
        return view('backend.pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidangs = Bidang::all();
        $jabatans = Jabatan::all();
        return view('backend.pegawai.create', compact('bidangs','jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan_id' => 'required|exists:jabatans,id',
            'bidang_id' => 'required|exists:bidangs,id',
            'foto' => 'image|mimes:jpg,jpeg|max:2048',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('pegawai', $image->hashName());

        //create 
        Pegawai::create([
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'bidang_id' => $request->bidang_id,
            'foto' => $image->hashName(),
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
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
        $pegawais = Pegawai::find($id);
        $bidangs = Bidang::get();
        $jabatans = Jabatan::get();

        return view('backend.pegawai.edit', compact('pegawais', 'bidangs', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan_id' => 'required|exists:bidangs,id',
            'bidang_id' => 'required|exists:bidangs,id',
            'foto' => 'image|mimes:jpg,jpeg|max:2048',
        ]);

        //get product by ID
        $pegawais = Pegawai::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {
            //delete old image
            Storage::delete('pegawai/' . $pegawais->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('pegawai', $image->hashName());

            //update product with new image
            $pegawais->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jabatan_id' => $request->jabatan_id,
                'bidang_id' => $request->bidang_id,
                'foto' => $image->hashName(),
            ]);
        } else {
            //update without image
            $pegawais->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jabatan_id' => $request->jabatan_id,
                'bidang_id' => $request->bidang_id,
            ]);
        }

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $pegawais = Pegawai::findOrFail($id);

        //delete image
        Storage::delete('pegawai/' . $pegawais->foto);

        //delete image
        $pegawais->delete();

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
