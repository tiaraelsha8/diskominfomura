<?php

namespace App\Imports;

use App\Models\Lokasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LokasiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lokasi([
            'nama_lokasi' => $row['nama_lokasi'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}
