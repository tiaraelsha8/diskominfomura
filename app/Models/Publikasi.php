<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;

    protected $table = 'publikasis';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'foto',
        'file_path',
        'file_original_name',
        'download_count',
    ];

    // public function getFileSizeHumanAttribute(): string
    // {
    //     if (!Storage::disk('publications')->exists($this->file_path)) {
    //         return '-';
    //     }

    //     $bytes = Storage::disk('publications')->size($this->file_path);
    //     $units = ['B', 'KB', 'MB', 'GB'];
    //     $i = 0;
    //     while ($bytes >= 1024 && $i < count($units) - 1) {
    //         $bytes /= 1024;
    //         $i++;
    //     }
    //     return round($bytes, 2) . ' ' . $units[$i];
    // }
}
