<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatistikPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'statistik_pekerjaan';

    protected $fillable = [
        'pekerjaan',
        'laki_laki',
        'perempuan',
    ];

    public function getJumlahAttribute(): int
    {
        return $this->laki_laki + $this->perempuan;
    }
}