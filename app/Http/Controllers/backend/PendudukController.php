<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $penduduks = StatistikPenduduk::when($request->search, function ($query, $search) {
            $query->where('pekerjaan', 'like', "%{$search}%")
                ->orWhere('agama', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(15);

        return view('backend.penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        return view('backend.penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jk' => 'required|in:L,P',
            'umur' => 'nullable|integer|min:0|max:150',
            'status_kawin' => 'nullable|string|max:50',
            'agama' => 'nullable|string|max:50',
            'hub_krt' => 'nullable|string|max:50',
            'jenjang' => 'nullable|string|max:50',
            'ijazah' => 'nullable|string|max:50',
            'status_bekerja' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'sektor' => 'nullable|string|max:50',
            'jenis_disabilitas' => 'nullable|string|max:100',
            'jenis_penyakit' => 'nullable|string|max:100',
        ]);

        StatistikPenduduk::create($validated);

        return redirect()
            ->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penduduk = StatistikPenduduk::findOrFail($id);

        return view('backend.penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $penduduk = StatistikPenduduk::findOrFail($id);

        $validated = $request->validate([
            'jk' => 'required|in:L,P',
            'umur' => 'nullable|integer|min:0|max:150',
            'status_kawin' => 'nullable|string|max:50',
            'agama' => 'nullable|string|max:50',
            'hub_krt' => 'nullable|string|max:50',
            'jenjang' => 'nullable|string|max:50',
            'ijazah' => 'nullable|string|max:50',
            'status_bekerja' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'sektor' => 'nullable|string|max:50',
            'jenis_disabilitas' => 'nullable|string|max:100',
            'jenis_penyakit' => 'nullable|string|max:100',
        ]);

        $penduduk->update($validated);

        return redirect()
            ->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penduduk = StatistikPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()
            ->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }
}