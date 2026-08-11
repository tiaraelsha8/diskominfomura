<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikIjazah;
use App\Traits\HasStatistikImportExport;

class StatistikIjazahController extends Controller
{
    use HasStatistikImportExport;

    protected string $importModel = StatistikIjazah::class;
    protected string $importLabelColumn = 'ijazah_tertinggi';
    protected string $importLabelHeading = 'Ijazah Tertinggi';
    protected string $importRouteIndex = 'ijazah-tertinggi.index';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ijazahTertinggis = StatistikIjazah::all();
        return view('backend.ijazah-tertinggi.index', compact('ijazahTertinggis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.ijazah-tertinggi.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'ijazah_tertinggi'  => 'required|string|max:100|unique:statistik_ijazah,ijazah_tertinggi',
    //         'laki_laki' => 'required|integer|min:0',
    //         'perempuan' => 'required|integer|min:0',
    //     ]);

    //     StatistikIjazah::create($request->all());

    //     return redirect()->route('ijazah-tertinggi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ijazahTertinggi = StatistikIjazah::findOrFail($id);
        return view('backend.ijazah-tertinggi.edit', compact('ijazahTertinggi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'ijazah_tertinggi'  => 'required|string|max:100|unique:statistik_ijazah,ijazah_tertinggi,' . $id,
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
        ]);

        $ijazahTertinggi = StatistikIjazah::findOrFail($id);
        $ijazahTertinggi->update($request->only('laki_laki', 'perempuan'));

        return redirect()->route('ijazah-tertinggi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $ijazahTertinggi = StatistikIjazah::findOrFail($id);
    //     $ijazahTertinggi->delete();

    //     return redirect()->route('ijazah-tertinggi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}