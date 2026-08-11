<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatistikRentangUmur;

class StatistikRentangUmurSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            '0-4 Tahun',
            '5-9 Tahun',
            '10-14 Tahun',
            '15-19 Tahun',
            '20-24 Tahun',
            '25-29 Tahun',
            '30-34 Tahun',
            '35-39 Tahun',
            '40-44 Tahun',
            '45-49 Tahun',
            '50-54 Tahun',
            '55-59 Tahun',
            '60-64 Tahun',
            '65-69 Tahun',
            '70-74 Tahun',
            '75+ Tahun',
        ];

        foreach ($daftar as $rentang) {
            StatistikRentangUmur::firstOrCreate(['rentang_umur' => $rentang]);
        }
    }
}