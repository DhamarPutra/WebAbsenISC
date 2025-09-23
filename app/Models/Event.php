<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = [
        'id_isc',
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga',
        'image_path',
    ];
    public function absenEvent()
    {
        return $this->hasMany(AbsenEvent::class);
    }
}
