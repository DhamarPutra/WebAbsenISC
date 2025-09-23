<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_isc',
        'new_password',
        'selfie_path',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
