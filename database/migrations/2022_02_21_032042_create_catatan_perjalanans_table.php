<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanPerjalanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan_perjalanans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tanggal');
            $table->time('chek_in');
            $table->time('chek_out')->nullable();
            $table->string('lokasi_kunjung');
            $table->string('suhu_tubuh');
            $table->string('gambar_lokasi')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catatan_perjalanans');
    }
}
