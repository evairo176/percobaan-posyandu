<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRekapPosyanduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rekap_posyandu', function (Blueprint $table) {
            $table->id('id');
            $table->integer('user_id');
            $table->string('nama_posyandu');
            $table->string('blok');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan_id');
            $table->string('kecamatan_id');
            $table->string('kabupaten_id');
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
        Schema::dropIfExists('tb_rekab_posyandu');
    }
}
