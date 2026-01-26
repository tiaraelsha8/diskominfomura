<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = ['judul', 'deskripsi', 'penulis', 'foto'];

    // protected function foto(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($foto) => url('/storage/berita/' . $foto),
    //     );
    // }
}
