<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'maklumat' => 'required',
            'video' => 'nullable|mimes:mp4,avi,mov,mkv,wmv,webm|max:20480', // max 20MB
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Siapkan data untuk insert
        $data = [
            'maklumat' => $request->maklumat,
        ];

        // Upload Foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('maklumats/foto', $foto->hashName(), 'public');
            $data['foto'] = $foto->hashName(); // cukup simpan nama file saja
        }

        // Upload Video
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $video->storeAs('maklumats/video', $video->hashName(), 'public');
            $data['video'] = $video->hashName();
        }

        // Simpan ke database
        Maklumat::create($data);

        //redirect to index
        return redirect()
            ->route('maklumat.index')
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
            'maklumat' => 'required',
            'video' => 'nullable|mimes:mp4|max:20480', // max 20MB
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        //get product by ID
        $maklumats = Maklumat::findOrFail($id);

        $data = [
            'maklumat' => $request->maklumat,
        ];

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($maklumats->foto && Storage::disk('public')->exists('maklumats/foto/' . $maklumats->foto)) {
                Storage::disk('public')->delete('maklumats/foto/' . $maklumats->foto);
            }

            // upload baru
            $foto = $request->file('foto');
            $foto->storeAs('maklumats/foto', $foto->hashName(), 'public');

            // simpan hanya nama file ke DB
            $data['foto'] = $foto->hashName();
        }

        if ($request->hasFile('video')) {
            if ($maklumats->video && Storage::disk('public')->exists('maklumats/video/' . $maklumats->video)) {
                Storage::disk('public')->delete('maklumats/video/' . $maklumats->video);
            }

            $video = $request->file('video');
            $video->storeAs('maklumats/video', $video->hashName(), 'public');

            $data['video'] = $video->hashName();
        }
        //update
        $maklumats->update($data);

        //redirect to index
        return redirect()
            ->route('maklumat.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $maklumats = Maklumat::findOrFail($id);

        //hapus foto kalau ada
        if ($maklumats->foto && \Storage::disk('public')->exists($maklumats->foto)) {
            \Storage::disk('public')->delete($maklumats->foto);
        }

        //hapus video kalau ada
        if ($maklumats->video && \Storage::disk('public')->exists($maklumats->video)) {
            \Storage::disk('public')->delete($maklumats->video);
        }

        //delete
        $maklumats->delete();

        //redirect to index
        return redirect()
            ->route('maklumat.index')
            ->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
