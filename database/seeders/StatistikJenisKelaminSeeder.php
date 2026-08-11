<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatistikJenisKelamin;

class StatistikJenisKelaminSeeder extends Seeder
{
    public function run(): void
    {
        StatistikJenisKelamin::firstOrCreate(['jenis_kelamin' => 'Total Penduduk']);
    }
}