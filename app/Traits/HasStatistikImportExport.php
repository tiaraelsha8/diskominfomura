<?php

namespace App\Traits;

use App\Exports\StatistikTemplateExport;
use App\Imports\StatistikImport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Dipakai oleh Controller statistik (RentangUmur, JenisKelamin, Agama, dst).
 * Controller yang pakai trait ini wajib mendefinisikan properti:
 *   - $importModel        (class model, cth: RentangUmur::class)
 *   - $importLabelColumn  (nama kolom label, cth: 'rentang_umur')
 *   - $importRouteIndex   (nama route index untuk redirect, cth: 'rentang-umur.index')
 * Properti opsional:
 *   - $importLabelHeading (judul kolom label di file Excel, default hasil ucwords dari nama kolom)
 *   - $importExtraColumns (kolom tambahan selain laki_laki/perempuan, cth: ['jumlah_kk' => 'Jumlah Keluarga (KK)'])
 */
trait HasStatistikImportExport
{
    public function downloadTemplate()
    {
        $modelClass   = $this->importModel;
        $labelColumn  = $this->importLabelColumn;
        $labelHeading = $this->importLabelHeading ?? ucwords(str_replace('_', ' ', $labelColumn));
        $extraColumns = $this->importExtraColumns ?? [];

        $rows = $modelClass::orderBy('id')->get();

        $filename = Str::slug(class_basename($modelClass)) . '-template.xlsx';

        return Excel::download(
            new StatistikTemplateExport($rows, $labelColumn, $labelHeading, $extraColumns),
            $filename
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        $modelClass   = $this->importModel;
        $labelColumn  = $this->importLabelColumn;
        $extraColumns = array_keys($this->importExtraColumns ?? []);

        $import = new StatistikImport($modelClass, $labelColumn, $extraColumns);
        Excel::import($import, $request->file('file'));

        $message = "{$import->updated} baris berhasil diperbarui dari file import.";
        if (!empty($import->tidakDikenali)) {
            $message .= ' Baris berikut tidak dikenali dan dilewati: ' . implode(', ', $import->tidakDikenali) . '.';
        }

        return redirect()->route($this->importRouteIndex)->with(['success' => $message]);
    }
}