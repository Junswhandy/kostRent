<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    protected $fillable = [
        'id_user',
        'id_kost',
        'tanggal_masuk',
        'hitungan_sewa',
        'durasi_sewa',
        'tanggal_keluar',
        'jumlah_kamar',
        'status',
    ];

    // Relasi ke model Kost
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost', 'id_kost');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

