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
        return view('backend.pegawai.create', compact('bidangs', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan_id' => [
                'required',
                'exists:jabatans,id',
                function ($attribute, $value, $fail) {
                    // Ambil nama jabatan dari ID
                    $jabatan = \App\Models\Jabatan::find($value);

                    if (!$jabatan) {
                        return;
                    }

                    if (strtolower($jabatan->nama_jabatan) === 'kepala dinas') {
                        $sudahAda = \App\Models\Pegawai::whereHas('jabatan', function ($q) {
                            $q->whereRaw('LOWER(nama_jabatan) = ?', ['kepala dinas']);
                        })->exists();

                        if ($sudahAda) {
                            $fail('Jabatan Kepala Dinas sudah terisi.');
                        }
                    }

                    if (strtolower($jabatan->nama_jabatan) === 'sekretaris') {
                        $sudahAda = \App\Models\Pegawai::whereHas('jabatan', function ($q) {
                            $q->whereRaw('LOWER(nama_jabatan) = ?', ['sekretaris']);
                        })->exists();

                        if ($sudahAda) {
                            $fail('Jabatan Sekretaris sudah terisi.');
                        }
                    }
                },
            ],
            'bidang_id' => 'required|exists:bidangs,id',
            'tupoksi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'required|mimes:pdf|max:5120', //5 mb
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('pegawai', $image->hashName());

        //upload file
        $file = $request->file('file');
        $file->storeAs('pegawai/dokumen', $file->hashName());

        //create
        Pegawai::create([
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'bidang_id' => $request->bidang_id,
            'tupoksi' => $request->tupoksi,
            'foto' => $image->hashName(),
            'file' => $file->hashName(),
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
            'jabatan_id' => [
                'required',
                'exists:jabatans,id',
                function ($attribute, $value, $fail) use ($id) {
                    $jabatan = \App\Models\Jabatan::find($value);
                    if (!$jabatan) {
                        return;
                    }

                    // Validasi Kepala Dinas
                    if (strtolower($jabatan->nama_jabatan) === 'kepala dinas') {
                        $sudahAda = \App\Models\Pegawai::whereHas('jabatan', function ($q) {
                            $q->whereRaw('LOWER(nama_jabatan) = ?', ['kepala dinas']);
                        })
                            ->where('id', '!=', $id)
                            ->exists();

                        if ($sudahAda) {
                            $fail('Jabatan Kepala Dinas sudah dipakai oleh pegawai lain.');
                        }
                    }

                    // Validasi Sekretaris
                    if (strtolower($jabatan->nama_jabatan) === 'sekretaris') {
                        $sudahAda = \App\Models\Pegawai::whereHas('jabatan', function ($q) {
                            $q->whereRaw('LOWER(nama_jabatan) = ?', ['sekretaris']);
                        })
                            ->where('id', '!=', $id)
                            ->exists();

                        if ($sudahAda) {
                            $fail('Jabatan Sekretaris sudah dipakai oleh pegawai lain.');
                        }
                    }
                },
            ],
            'bidang_id' => 'required|exists:bidangs,id',
            'foto' => 'image|mimes:jpg,jpeg|max:2048',
            'tupoksi' => 'required',
            'file' => 'mimes:pdf|max:5120', //5 mb
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
                'tupoksi' => $request->tupoksi,
                'jabatan_id' => $request->jabatan_id,
                'bidang_id' => $request->bidang_id,
                'foto' => $image->hashName(),
            ]);
        } 
        elseif ($request->hasFile('file')) {
            //delete old image
            Storage::delete('pegawai/dokumen/' . $pegawais->file);


            //upload file
            $file = $request->file('file');
            $file->storeAs('pegawai/dokumen', $file->hashName());

            //update product with new image
            $pegawais->update([
                'nama' => $request->nama,
                'tupoksi' => $request->tupoksi,
                'jabatan_id' => $request->jabatan_id,
                'bidang_id' => $request->bidang_id,
                'file' => $file->hashName(),
            ]);
        }
        else {
            //update without image
            $pegawais->update([
                'nama' => $request->nama,
                'tupoksi' => $request->tupoksi,
                'jabatan_id' => $request->jabatan_id,
                'bidang_id' => $request->bidang_id,
            ]);
        }

        //redirect to index
        return redirect()
            ->route('pegawai.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
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
        Storage::delete('pegawai/dokumen/' . $pegawais->file);

        //delete image
        $pegawais->delete();

        //redirect to index
        return redirect()
            ->route('pegawai.index')
            ->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function download($id)
    {
        $dokumen = Pegawai::findOrFail($id); // pastikan modelnya sesuai

        $filename = $dokumen->file;
        $path = storage_path('app/public/pegawai/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $dokumen->file . '"',
        ]);
    }
}
