<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs';

    protected $fillable = ['nama_bidang'];

    // public function pegawais()
    // {
    //     return $this->hasMany(Pegawai::class, 'bidang_id');
    // }
}
