<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumens';

    protected $fillable = ['nama_dok', 'keterangan', 'file'];
}
