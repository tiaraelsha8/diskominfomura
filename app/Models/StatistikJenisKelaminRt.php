<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatistikJenisKelaminRt extends Model
{
    use HasFactory;

    protected $table = 'statistik_jk_rt';

    protected $fillable = [
        'rt',
        'laki_laki',
        'perempuan',
        'jumlah_kk',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::syncTotal());
        static::deleted(fn () => static::syncTotal());
    }

    /**
     * Normalisasi format RT: "rt01", " RT  1 " -> "RT 01".
     */
    public static function normalizeRt(string $rt): string
    {
        $rt = trim($rt);
        $rt = preg_replace('/\s+/', ' ', $rt);
        $rt = preg_replace('/^rt\s*/i', '', $rt);
        $number = preg_replace('/[^0-9]/', '', $rt);

        if ($number === '') {
            return 'RT ' . $rt;
        }

        return 'RT ' . str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Sinkronkan total ke tabel statistik_jk berdasarkan SUM semua RT.
     */
    public static function syncTotal(): void
    {
        $totals = static::selectRaw('SUM(laki_laki) as laki_laki, SUM(perempuan) as perempuan, SUM(jumlah_kk) as jumlah_kk')
            ->first();

        StatistikJenisKelamin::query()->update([
            'laki_laki' => $totals->laki_laki ?? 0,
            'perempuan' => $totals->perempuan ?? 0,
            'jumlah_kk' => $totals->jumlah_kk ?? 0,
        ]);
    }

    public function getJumlahAttribute(): int
    {
        return $this->laki_laki + $this->perempuan;
    }
}