<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatistikRentangUmur extends Model
{
    use HasFactory;

    protected $table = 'statistik_rentang_umur';

    protected $fillable = [
        'rentang_umur',
        'laki_laki',
        'perempuan',
    ];

    public function getJumlahAttribute(): int
    {
        return $this->laki_laki + $this->perempuan;
    }
}