<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tentangs';

    protected $fillable = ['tentang'];
}
