<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatistikIjazah extends Model
{
    use HasFactory;

    protected $table = 'statistik_ijazah';

    protected $fillable = [
        'ijazah_tertinggi',
        'laki_laki',
        'perempuan',
    ];

    public function getJumlahAttribute(): int
    {
        return $this->laki_laki + $this->perempuan;
    }
}
