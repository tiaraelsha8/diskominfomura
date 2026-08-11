<?php
namespace App\Services;

use App\Models\StatistikPenduduk;

class StatistikPendudukService
{
    protected array $rentangUmurMap = [
        ['min' => 0,  'max' => 1,    'label' => '0 S/D 1 TAHUN'],
        ['min' => 2,  'max' => 4,    'label' => '2 s/d 4 Tahun'],
        ['min' => 5,  'max' => 9,    'label' => '5 s/d 9 Tahun'],
        ['min' => 10, 'max' => 14,   'label' => '10 s/d 14 Tahun'],
        ['min' => 15, 'max' => 19,   'label' => '15 s/d 19 Tahun'],
        ['min' => 20, 'max' => 24,   'label' => '20 s/d 24 Tahun'],
        ['min' => 25, 'max' => 29,   'label' => '25 s/d 29 Tahun'],
        ['min' => 30, 'max' => 34,   'label' => '30 s/d 34 Tahun'],
        ['min' => 35, 'max' => 39,   'label' => '35 s/d 39 Tahun'],
        ['min' => 40, 'max' => 44,   'label' => '40 s/d 44 Tahun'],
        ['min' => 45, 'max' => 49,   'label' => '45 s/d 49 Tahun'],
        ['min' => 50, 'max' => 54,   'label' => '50 s/d 54 Tahun'],
        ['min' => 55, 'max' => 59,   'label' => '55 s/d 59 Tahun'],
        ['min' => 60, 'max' => 64,   'label' => '60 s/d 64 Tahun'],
        ['min' => 65, 'max' => 69,   'label' => '65 s/d 69 Tahun'],
        ['min' => 70, 'max' => 74,   'label' => '70 s/d 74 Tahun'],
        ['min' => 75, 'max' => null, 'label' => '75 Tahun ke atas'],
    ];

    protected function baseQuery()
    {
        return StatistikPenduduk::query();
    }

    public function rentangUmur(): array
    {
        $totalJiwa = $this->baseQuery()->count();
        $totalLaki = $this->baseQuery()->where('jk', 'L')->count();
        $totalPerempuan = $this->baseQuery()->where('jk', 'P')->count();

        $rows = collect($this->rentangUmurMap)->map(function ($range) use ($totalJiwa, $totalLaki, $totalPerempuan) {
            $query = fn () => $this->baseQuery()->when(
                $range['max'] === null,
                fn ($q) => $q->where('umur', '>=', $range['min']),
                fn ($q) => $q->whereBetween('umur', [$range['min'], $range['max']])
            );

            $jumlah = $query()->count();
            $laki = $query()->where('jk', 'L')->count();
            $perempuan = $query()->where('jk', 'P')->count();

            return [
                'label'            => $range['label'],
                'jumlah'           => $jumlah,
                'jumlah_persen'    => $this->persen($jumlah, $totalJiwa),
                'laki'             => $laki,
                'laki_persen'      => $this->persen($laki, $totalLaki),
                'perempuan'        => $perempuan,
                'perempuan_persen' => $this->persen($perempuan, $totalPerempuan),
            ];
        });

        return [
            'rows'  => $rows,
            'total' => [
                'jumlah'    => $totalJiwa,
                'laki'      => $totalLaki,
                'perempuan' => $totalPerempuan,
            ],
        ];
    }

    public function jenisKelamin(): array
    {
        $totalJiwa = $this->baseQuery()->count();
        $laki = $this->baseQuery()->where('jk', 'L')->count();
        $perempuan = $this->baseQuery()->where('jk', 'P')->count();

        return [
            'rows' => [
                ['label' => 'Laki-laki', 'jumlah' => $laki, 'persen' => $this->persen($laki, $totalJiwa)],
                ['label' => 'Perempuan', 'jumlah' => $perempuan, 'persen' => $this->persen($perempuan, $totalJiwa)],
            ],
            'total' => $totalJiwa,
        ];
    }

    public function agama(): array
    {
        $totalJiwa = $this->baseQuery()->count();

        $data = $this->baseQuery()
            ->selectRaw('agama, jk, COUNT(*) as jumlah')
            ->groupBy('agama', 'jk')
            ->get()
            ->groupBy('agama');

        $rows = $data->map(function ($items, $agama) use ($totalJiwa) {
            $laki = (int) $items->where('jk', 'L')->sum('jumlah');
            $perempuan = (int) $items->where('jk', 'P')->sum('jumlah');
            $jumlah = $laki + $perempuan;

            return [
                'label'         => $agama ?: 'Tidak Diketahui',
                'jumlah'        => $jumlah,
                'jumlah_persen' => $this->persen($jumlah, $totalJiwa),
                'laki'          => $laki,
                'perempuan'     => $perempuan,
            ];
        })->sortByDesc('jumlah')->values();

        return [
            'rows'  => $rows,
            'total' => $totalJiwa,
        ];
    }

    protected function persen(int $bagian, int $total): string
    {
        if ($total === 0) {
            return '0,00%';
        }

        return number_format(($bagian / $total) * 100, 2, ',', '.') . '%';
    }
}
