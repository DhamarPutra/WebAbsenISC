<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_isc';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_isc',
        'nama_mahasiswa',
        'nim',
        'peminatan',
        'english_class',
    ];

    public function absens()
    {
        return $this->hasMany(Absen::class, 'id_isc', 'id_isc');
    }
    
    public function absens_hadir()
    {
        return $this->hasMany(Absen::class, 'id_isc', 'id_isc')->where('status', 'Hadir');
    }

    public function absenEvent()
    {
        return $this->hasMany(AbsenEvent::class, 'id_isc', 'id_isc');
    }
    
    public function eventRegist()
    {
        return $this->hasMany(EventRegist::class, 'id_isc', 'id_isc');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_isc');
    }
    
    public function nfc()
    {
        return $this->belongsTo(NfcCard::class, 'id_isc');
    }
}
