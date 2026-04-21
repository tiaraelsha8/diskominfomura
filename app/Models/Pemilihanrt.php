<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemilihanrt extends Model
{
    use HasFactory;

    protected $table = 'pemilihanrts';

    protected $fillable = ['nama_rt', 'deskripsi', 'link_pemilihan', 'link_hasil'];
}
