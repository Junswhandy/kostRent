<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kost', function (Blueprint $table) {
            $table->id('id_kost');
            $table->string('nama_kost', 255);
            $table->string('tipe_kost', 255);
            $table->string('jenis_kost', 255);
            $table->integer('jumlah_kamar');
            $table->date('tanggal_tagih');
            $table->text('nama_pemilik');
            $table->text('nama_bank');
            $table->integer('no_rekening');
            $table->string('foto_bangunan_utama', 255);
            $table->string('foto_kamar', 255);
            $table->string('foto_kamar_mandi', 255);
            $table->string('foto_interior', 255);
            $table->string('provinsi', 25);
            $table->string('kota', 25);
            $table->string('kecamatan', 25);
            $table->string('kelurahan', 25);
            $table->string('alamat', 255);
            $table->integer('harga_sewa');
            $table->string('kontak', 255);
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_pemilik');
            $table->text('fasilitas_kost');
            $table->text('link_gmaps');
            $table->timestamps();

            // Menambahkan foreign key jika ada relasi dengan tabel pemilik
            $table->foreign('id_pemilik')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kost');
    }
}
