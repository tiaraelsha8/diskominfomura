<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatistikPekerjaan;

class StatistikPekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            'Petani',
            'Nelayan',
            'Tambang',
            'PNS/ASN',
            'Wiraswasta',
            'Buruh',
            'Belum/Tidak Bekerja',
            'Lainnya',
        ];

        foreach ($daftar as $pekerjaan) {
            StatistikPekerjaan::firstOrCreate(['pekerjaan' => $pekerjaan]);
        }
    }
}