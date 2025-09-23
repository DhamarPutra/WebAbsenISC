<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $table = 'berita_acara';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'image_path',
    ];
}
