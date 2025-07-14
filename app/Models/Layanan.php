<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $fillable = ['nama_layanan', 'deskripsi', 'link', 'logo', 'background'];
}
