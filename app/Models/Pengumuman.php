<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = ['judul', 'deskripsi', 'penulis', 'foto','file'];

    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn ($foto) => url('/storage/pengumuman/' . $foto),
        );
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($file) => url('/storage/pengumuman/dokumen/' . $file),
        );
    }
}

