<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kost'; // Nama tabel di database

    // Kolom yang dapat diisi (mass assignable)
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
        'link_gmaps'
    ];
}
