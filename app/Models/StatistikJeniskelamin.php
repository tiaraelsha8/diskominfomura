<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatistikJenisKelamin extends Model
{
    use HasFactory;

    protected $table = 'statistik_jk';

    protected $fillable = [
        'jenis_kelamin',
        'laki_laki',
        'perempuan',
        'jumlah_kk',
    ];

    public function getJumlahAttribute(): int
    {
        return $this->laki_laki + $this->perempuan;
    }
}