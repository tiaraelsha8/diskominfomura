<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profilbidang extends Model
{
    use HasFactory;

    protected $table = 'profilbidangs';

    protected $fillable = ['nama_bidang', 'deskripsi', 'foto'];
}
