<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user')->index();
            $table->unsignedBigInteger('id_kost')->index();
            $table->date('tanggal_masuk');
            $table->integer('hitungan_sewa');
            $table->integer('durasi_sewa');
            $table->date('tanggal_keluar');
            $table->integer('jumlah_kamar');
            $table->timestamps();

            // Foreign key constraints (optional, depends on related tables)
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kamar')->references('id_kost')->on('kost')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
