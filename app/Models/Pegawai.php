<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = ['nama', 'jabatan', 'bidang_id', 'jabatan_id', 'foto', 'tupoksi','file'];

    // Relasi ke Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    // Relasi ke Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
