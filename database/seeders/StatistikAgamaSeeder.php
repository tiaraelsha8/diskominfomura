<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatistikAgama;

class StatistikAgamaSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Buddha',
            'Konghucu',
            'Kepercayaan Lainnya',
        ];

        foreach ($daftar as $agama) {
            StatistikAgama::firstOrCreate(['agama' => $agama]);
        }
    }
}