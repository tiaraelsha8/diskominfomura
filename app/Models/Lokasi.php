<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi_internet';

    protected $fillable = [
        'nama_lokasi',
        'latitude',
        'longitude',
        'keterangan',
    ];
}
