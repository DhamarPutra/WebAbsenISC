<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenEvent extends Model
{
    use HasFactory;
    protected $table = 'absen_event';
    protected $fillable = [
        'id_isc',
        'event_id',
        'absen_masuk',
        'absen_keluar',
        'status_kehadiran',
        'link_sertifikat',
        'image_path',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_isc', 'id_isc');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
