<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsipgaleri extends Model
{
    use HasFactory;

    protected $table = 'arsipgaleris';

    protected $fillable = ['nama_galeri', 'foto'];

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'arsipgaleri_id');
    }
}
