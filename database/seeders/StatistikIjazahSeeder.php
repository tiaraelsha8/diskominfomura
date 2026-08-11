<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatistikIjazah;

class StatistikIjazahSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            'Tidak/Belum Sekolah',
            'SD/Sederajat',
            'SMP/Sederajat',
            'SMA/Sederajat',
            'D1/D2',
            'D3',
            'D4/S1',
            'S2',
            'S3',
        ];

        foreach ($daftar as $ijazah) {
            StatistikIjazah::firstOrCreate(['ijazah_tertinggi' => $ijazah]);
        }
    }
}