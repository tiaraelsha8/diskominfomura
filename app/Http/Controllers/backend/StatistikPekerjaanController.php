<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikPekerjaan;
use App\Traits\HasStatistikImportExport;

class StatistikPekerjaanController extends Controller
{
    use HasStatistikImportExport;

    protected string $importModel = StatistikPekerjaan::class;
    protected string $importLabelColumn = 'pekerjaan';
    protected string $importRouteIndex = 'pekerjaan.index';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pekerjaans = StatistikPekerjaan::all();
        return view('backend.pekerjaan.index', compact('pekerjaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.pekerjaan.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'pekerjaan'  => 'required|string|max:100|unique:statistik_pekerjaan,pekerjaan',
    //         'laki_laki' => 'required|integer|min:0',
    //         'perempuan' => 'required|integer|min:0',
    //     ]);

    //     StatistikPekerjaan::create($request->all());

    //     return redirect()->route('pekerjaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pekerjaan = StatistikPekerjaan::findOrFail($id);
        return view('backend.pekerjaan.edit', compact('pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'pekerjaan'  => 'required|string|max:100|unique:statistik_pekerjaan,pekerjaan,' . $id,
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
        ]);

        $pekerjaan = StatistikPekerjaan::findOrFail($id);
        $pekerjaan->update($request->only('laki_laki', 'perempuan'));

        return redirect()->route('pekerjaan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $pekerjaan = StatistikPekerjaan::findOrFail($id);
    //     $pekerjaan->delete();

    //     return redirect()->route('pekerjaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}