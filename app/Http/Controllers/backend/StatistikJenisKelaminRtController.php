<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikJenisKelaminRt;
use App\Exports\StatistikTemplateExport;
use App\Imports\StatistikRtImport;
use Maatwebsite\Excel\Facades\Excel;

class StatistikJenisKelaminRtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisKelaminRts = StatistikJenisKelaminRt::orderByRaw(
            'CAST(REGEXP_REPLACE(rt, "[^0-9]", "") AS UNSIGNED) ASC'
        )->get();

        return view('backend.jenis-kelamin-rt.index', compact('jenisKelaminRts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.jenis-kelamin-rt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rt'         => 'required|string|max:50|unique:statistik_jk_rt,rt',
            'laki_laki'  => 'required|integer|min:0',
            'perempuan'  => 'required|integer|min:0',
            'jumlah_kk'  => 'required|integer|min:0',
        ]);

        StatistikJenisKelaminRt::create($request->only('rt', 'laki_laki', 'perempuan', 'jumlah_kk'));

        return redirect()->route('jenis-kelamin-rt.index')->with(['success' => 'Data RT Berhasil Ditambahkan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisKelaminRt = StatistikJenisKelaminRt::findOrFail($id);
        return view('backend.jenis-kelamin-rt.edit', compact('jenisKelaminRt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisKelaminRt = StatistikJenisKelaminRt::findOrFail($id);

        $request->validate([
            'rt'         => 'required|string|max:50|unique:statistik_jk_rt,rt,' . $id,
            'laki_laki'  => 'required|integer|min:0',
            'perempuan'  => 'required|integer|min:0',
            'jumlah_kk'  => 'required|integer|min:0',
        ]);

        $jenisKelaminRt->update($request->only('rt', 'laki_laki', 'perempuan', 'jumlah_kk'));

        return redirect()->route('jenis-kelamin-rt.index')->with(['success' => 'Data RT Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisKelaminRt = StatistikJenisKelaminRt::findOrFail($id);
        $jenisKelaminRt->delete();

        return redirect()->route('jenis-kelamin-rt.index')->with(['success' => 'Data RT Berhasil Dihapus!']);
    }

    public function downloadTemplate()
{
    $rows = StatistikJenisKelaminRt::orderByRaw(
        'CAST(REGEXP_REPLACE(rt, "[^0-9]", "") AS UNSIGNED) ASC'
    )->get();

    return Excel::download(
        new StatistikTemplateExport($rows, 'rt', 'RT', ['jumlah_kk' => 'Jumlah Keluarga (KK)']),
        'jenis-kelamin-rt-template.xlsx'
    );
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls|max:2048',
    ]);

    $import = new StatistikRtImport();
    Excel::import($import, $request->file('file'));

    $message = "{$import->created} RT baru ditambahkan, {$import->updated} RT diperbarui dari file import.";

    return redirect()->route('jenis-kelamin-rt.index')->with(['success' => $message]);
}
}