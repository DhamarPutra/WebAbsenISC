<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'modul';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'bidang',
        'uploader',
        'file_path',
        'gdrive_file_id',
    ];
}
