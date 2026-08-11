<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    protected $table = 'penduduks';

    protected $fillable = [
    'jk', 'umur', 'status_kawin', 'agama', 'hub_krt', 'jenjang',
    'ijazah', 'status_bekerja', 'pekerjaan', 'sektor',
    'jenis_disabilitas', 'jenis_penyakit',
];
}
