<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publikasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publikasi = Publikasi::latest()->get();
        return view('backend.publikasi.index', compact('publikasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.publikasi.create');
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
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'file' => 'required|mimes:pdf|max:20480',
        ]);

        //upload cover (kalau ada) - simpan ke disk 'public' supaya bisa diakses lewat storage:link
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image->storeAs('publikasi/covers', $image->hashName(), 'public');
            $fotoName = 'covers/' . $image->hashName();
        }

        //upload file pdf - simpan ke disk 'public'
        $file = $request->file('file');
        $file->storeAs('publikasi/files', $file->hashName(), 'public');

        //create publikasi
        Publikasi::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . Str::random(6),
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoName,
            'file_path' => 'files/' . $file->hashName(),
            'file_original_name' => $file->getClientOriginalName(),
        ]);

        //redirect to index
        return redirect()->route('publikasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        //get publikasi by ID
        $publikasi = Publikasi::findOrFail($id);

        //render view with publikasi
        return view('backend.publikasi.edit', compact('publikasi'));
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
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'file' => 'nullable|mimes:pdf|max:20480',
        ]);

        //get publikasi by ID
        $publikasi = Publikasi::findOrFail($id);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        //check if new cover uploaded
        if ($request->hasFile('foto')) {
            //delete old cover (disk 'public')
            if ($publikasi->foto) {
                Storage::disk('public')->delete('publikasi/' . $publikasi->foto);
            }

            //upload new cover
            $image = $request->file('foto');
            $image->storeAs('publikasi/covers', $image->hashName(), 'public');
            $data['foto'] = 'covers/' . $image->hashName();
        }

        //check if new file uploaded
        if ($request->hasFile('file')) {
            //delete old file (disk 'public')
            if ($publikasi->file_path) {
                Storage::disk('public')->delete('publikasi/' . $publikasi->file_path);
            }

            //upload new file
            $file = $request->file('file');
            $file->storeAs('publikasi/files', $file->hashName(), 'public');
            $data['file_path'] = 'files/' . $file->hashName();
            $data['file_original_name'] = $file->getClientOriginalName();
        }

        //update publikasi
        $publikasi->update($data);

        //redirect to index
        return redirect()->route('publikasi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $publikasi = Publikasi::findOrFail($id);

        //delete cover (disk 'public')
        if ($publikasi->foto) {
            Storage::disk('public')->delete('publikasi/' . $publikasi->foto);
        }

        //delete file (disk 'public')
        if ($publikasi->file_path) {
            Storage::disk('public')->delete('publikasi/' . $publikasi->file_path);
        }

        //delete data
        $publikasi->delete();

        //redirect to index
        return redirect()->route('publikasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}