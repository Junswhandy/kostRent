<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfirmasiBayarTable extends Migration
{
    public function up()
    {
        Schema::create('konfirmasi_bayar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kost');
            $table->date('tanggal_bayar')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kost')->references('id_kost')->on('kost')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('konfirmasi_bayar');
    }
}

