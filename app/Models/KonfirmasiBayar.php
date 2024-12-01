<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiBayar extends Model
{
    use HasFactory;

    protected $table = 'konfirmasi_bayar';

    protected $fillable = [
        'id_user',
        'id_kost',
        'tanggal_bayar',
        'bukti_bayar',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Kost
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost');
    }
}
