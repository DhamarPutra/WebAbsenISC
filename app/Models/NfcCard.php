<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NfcCard extends Model
{
    use HasFactory;
    protected $fillable = ['uid', 'id_isc'];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_isc', 'id_isc');
    }
}
