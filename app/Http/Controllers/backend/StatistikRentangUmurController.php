<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikRentangUmur;
use App\Traits\HasStatistikImportExport;

class StatistikRentangUmurController extends Controller
{
    use HasStatistikImportExport;

    protected string $importModel = StatistikRentangUmur::class;
    protected string $importLabelColumn = 'rentang_umur';
    protected string $importRouteIndex = 'rentang-umur.index';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentangUmurs = StatistikRentangUmur::all();
        return view('backend.rentang-umur.index', compact('rentangUmurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.rentang-umur.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'rentang_umur'  => 'required|string|max:100|unique:statistik_rentang_umur,rentang_umur',
    //         'laki_laki' => 'required|integer|min:0',
    //         'perempuan' => 'required|integer|min:0',
    //     ]);

    //     StatistikRentangUmur::create($request->all());

    //     return redirect()->route('rentang-umur.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rentangUmur = StatistikRentangUmur::findOrFail($id);
        return view('backend.rentang-umur.edit', compact('rentangUmur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'rentang_umur'  => 'required|string|max:100|unique:statistik_rentang_umur,rentang_umur,' . $id,
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
        ]);

        $rentangUmur = StatistikRentangUmur::findOrFail($id);
        // $rentangUmur->update($request->all());
        $rentangUmur->update($request->only('laki_laki', 'perempuan'));

        return redirect()->route('rentang-umur.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rentangUmur = StatistikRentangUmur::findOrFail($id);
        $rentangUmur->delete();

        return redirect()->route('rentang-umur.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}