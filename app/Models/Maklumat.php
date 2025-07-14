<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maklumat extends Model
{
    use HasFactory;

    protected $table = 'maklumats';

    protected $fillable = ['maklumat'];
}
