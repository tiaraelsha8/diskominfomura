<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikJenisKelamin;
use App\Traits\HasStatistikImportExport;

class StatistikJenisKelaminController extends Controller
{
    use HasStatistikImportExport;

    protected string $importModel = StatistikJenisKelamin::class;
    protected string $importLabelColumn = 'jenis_kelamin';
    protected string $importRouteIndex = 'jenis-kelamin.index';
    protected array $importExtraColumns = ['jumlah_kk' => 'Jumlah Keluarga (KK)'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisKelamins = StatistikJenisKelamin::all();
        return view('backend.jenis-kelamin.index', compact('jenisKelamins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.jenis-kelamin.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'jenis_kelamin'  => 'required|string|max:100|unique:statistik_jk,jenis_kelamin',
    //         'laki_laki' => 'required|integer|min:0',
    //         'perempuan' => 'required|integer|min:0',
    //     ]);

    //     StatistikJenisKelamin::create($request->all());

    //     return redirect()->route('jenis-kelamin.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisKelamin = StatistikJenisKelamin::findOrFail($id);
        return view('backend.jenis-kelamin.edit', compact('jenisKelamin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'jenis_kelamin'  => 'required|string|max:100|unique:statistik_jk,jenis_kelamin,' . $id,
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'jumlah_kk' => 'required|integer|min:0',
        ]);

        $jenisKelamin = StatistikJenisKelamin::findOrFail($id);
        $jenisKelamin->update($request->only('laki_laki', 'perempuan', 'jumlah_kk'));

        return redirect()->route('jenis-kelamin.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $jenisKelamin = StatistikJenisKelamin::findOrFail($id);
    //     $jenisKelamin->delete();

    //     return redirect()->route('jenis-kelamin.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}