<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikAgama;
use App\Traits\HasStatistikImportExport;

class StatistikAgamaController extends Controller
{
    use HasStatistikImportExport;
    protected string $importModel = StatistikAgama::class;
    protected string $importLabelColumn = 'agama';
    protected string $importRouteIndex = 'agama.index';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agamas = StatistikAgama::all();
        return view('backend.agama.index', compact('agamas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.agama.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'agama'  => 'required|string|max:100|unique:statistik_agama,agama',
    //         'laki_laki' => 'required|integer|min:0',
    //         'perempuan' => 'required|integer|min:0',
    //     ]);

    //     StatistikAgama::create($request->all());

    //     return redirect()->route('agama.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agama = StatistikAgama::findOrFail($id);
        return view('backend.agama.edit', compact('agama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'agama'  => 'required|string|max:100|unique:statistik_agama,agama,' . $id,
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
        ]);

        $agama = StatistikAgama::findOrFail($id);
        $agama->update($request->only('laki_laki', 'perempuan'));

        return redirect()->route('agama.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $agama = StatistikAgama::findOrFail($id);
    //     $agama->delete();

    //     return redirect()->route('agama.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}