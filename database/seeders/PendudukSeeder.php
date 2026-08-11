<?php

namespace Database\Seeders;

use App\Models\StatistikPenduduk;
use Illuminate\Database\Seeder;

class PendudukSeeder extends Seeder
{
    public function run(): void
    {
        $jumlahData = 500;

        // Bobot rentang umur, meniru piramida penduduk (lebih banyak usia muda)
        $umurWeighted = [
            [0, 1, 15], [2, 4, 25], [5, 9, 45], [10, 14, 50], [15, 19, 48],
            [20, 24, 50], [25, 29, 55], [30, 34, 55], [35, 39, 48],
            [40, 44, 45], [45, 49, 40], [50, 54, 35], [55, 59, 28],
            [60, 64, 20], [65, 69, 14], [70, 74, 10], [75, 90, 12],
        ];

        $agamaWeighted = [
            'Islam' => 82, 'Kristen' => 8, 'Katolik' => 5,
            'Hindu' => 2, 'Buddha' => 2, 'Konghucu' => 1,
        ];

        $pendidikanJenjang = ['TK', 'SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2', null];
        $ijazahOptions = ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2'];
        $statusKawinOptions = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        $hubKrtOptions = ['Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Famili Lain'];
        $pekerjaanOptions = [
            'Petani', 'Buruh Tani', 'Nelayan', 'PNS', 'TNI/Polri',
            'Pedagang', 'Wiraswasta', 'Guru', 'Karyawan Swasta',
            'Sopir', 'Tukang', 'Belum/Tidak Bekerja', 'Pelajar/Mahasiswa',
        ];
        $sektorOptions = ['Formal', 'Informal', null];
        $disabilitasOptions = [null, null, null, null, null, null, null, null, null, null, 'Fisik', 'Netra', 'Rungu', 'Mental'];
        $penyakitOptions = [null, null, null, null, null, null, null, null, null, null, 'Diabetes', 'Hipertensi', 'TBC', 'Jantung'];

        $data = [];

        for ($i = 0; $i < $jumlahData; $i++) {
            $umur = $this->weightedRandomRange($umurWeighted);
            $jk = fake()->randomElement(['L', 'P']);
            $agama = $this->weightedRandom($agamaWeighted);

            // Status kawin & pekerjaan disesuaikan kasar dengan umur biar masuk akal
            $statusKawin = $umur < 17
                ? 'Belum Kawin'
                : fake()->randomElement($statusKawinOptions);

            $statusBekerja = $umur >= 15 && $umur <= 64
                ? fake()->randomElement(['Bekerja', 'Bekerja', 'Bekerja', 'Tidak Bekerja'])
                : 'Tidak Bekerja';

            $pekerjaan = $statusBekerja === 'Bekerja'
                ? fake()->randomElement($pekerjaanOptions)
                : ($umur < 15 || $umur > 22 ? null : 'Pelajar/Mahasiswa');

            $data[] = [
                'jk'                => $jk,
                'umur'              => $umur,
                'status_kawin'      => $statusKawin,
                'agama'             => $agama,
                'hub_krt'           => fake()->randomElement($hubKrtOptions),
                'jenjang'           => $umur >= 5 && $umur <= 24 ? fake()->randomElement($pendidikanJenjang) : null,
                'ijazah'            => fake()->randomElement($ijazahOptions),
                'status_bekerja'    => $statusBekerja,
                'pekerjaan'         => $pekerjaan,
                'sektor'            => $statusBekerja === 'Bekerja' ? fake()->randomElement($sektorOptions) : null,
                'jenis_disabilitas' => fake()->randomElement($disabilitasOptions),
                'jenis_penyakit'    => fake()->randomElement($penyakitOptions),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        // Insert per-chunk biar tidak overload query tunggal
        foreach (array_chunk($data, 100) as $chunk) {
            StatistikPenduduk::insert($chunk);
        }

        $this->command->info("Berhasil generate {$jumlahData} data penduduk dummy.");
    }

    /**
     * Ambil 1 rentang umur secara acak berdasarkan bobot, lalu random angka di dalam rentang itu.
     */
    protected function weightedRandomRange(array $ranges): int
    {
        $totalWeight = array_sum(array_column($ranges, 2));
        $rand = mt_rand(1, $totalWeight);

        $cumulative = 0;
        foreach ($ranges as [$min, $max, $weight]) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return fake()->numberBetween($min, $max);
            }
        }

        return fake()->numberBetween(0, 90);
    }

    /**
     * Random 1 key dari array asosiatif berdasarkan bobot value-nya.
     */
    protected function weightedRandom(array $weighted): string
    {
        $totalWeight = array_sum($weighted);
        $rand = mt_rand(1, $totalWeight);

        $cumulative = 0;
        foreach ($weighted as $key => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $key;
            }
        }

        return array_key_first($weighted);
    }
}