<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = ['lokasi', 'linkmaps', 'telepon', 'email', 'link_ig', 'link_twitter', 'link_fb', 'link_tiktok', 'link_youtube'];
}
