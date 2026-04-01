<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = ['judul', 'deskripsi', 'arsipgaleri_id', 'foto'];

    public function arsipgaleris()
    {
        return $this->belongsTo(Arsipgaleri::class, 'arsipgaleri_id');
    }
}
