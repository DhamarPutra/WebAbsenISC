<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSurat extends Model
{
    use HasFactory;
    protected $table = 'nomor_surat';
    protected $fillable = [
        'id_isc',
        'jenis_surat_id',
        'nomor_surat',
        'tanggal_pengajuan',
        'waktu_pengajuan',
        'status',
    ];
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_isc', 'id_isc');
    }
}
