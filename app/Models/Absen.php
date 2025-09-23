<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absen';
    protected $fillable = [
        'id_isc',
        'pertemuan',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_isc', 'id_isc');
    }
}
