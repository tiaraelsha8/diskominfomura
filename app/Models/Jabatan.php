<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $fillable = ['nama_jabatan'];

    // Relasi ke Pegawai
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }

}
