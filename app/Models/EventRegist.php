<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegist extends Model
{
    use HasFactory;
    protected $table = 'event_regist';
    protected $fillable = [
        'id_isc',
        'id_event',
        'no_tagihan',
        'status_bayar',
        'barcode_tiket',
        'image_path',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_isc', 'id_isc');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }
}
