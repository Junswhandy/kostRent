<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kost'; // Mengatur nama tabel menjadi 'kost'

    protected $primaryKey = 'id_kost'; // Set primary key menjadi 'id_kost'

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama_kost',
        'tipe_kost',
        'jenis_kost',
        'jumlah_kamar',
        'tanggal_tagih',
        'nama_pemilik',
        'nama_bank',
        'no_rekening',
        'foto_bangunan_utama',
        'foto_kamar',
        'foto_kamar_mandi',
        'foto_interior',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat',
        'harga_sewa',
        'kontak',
        'deskripsi',
        'id_pemilik',
        'fasilitas_kost',
        'link_gmaps',
    ];

    // Relasi ke tabel pemilik (Login model)
    public function pemilik()
    {
        return $this->belongsTo(Login::class, 'id_pemilik');
    }

    // Relasi ke tabel booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_kost', 'id_kost'); // Sesuaikan kolom kunci asing
    }

    // Jika satu kost hanya dapat memiliki satu booking untuk user tertentu
    public function booking()
    {
        return $this->hasOne(Booking::class, 'id_kost', 'id_kost'); // Untuk hubungan satu ke satu
    }
}
