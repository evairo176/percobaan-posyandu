<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbGeografiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tb_geografi', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id');
            $table->string('jml_rt')->nullable();
            $table->string('jml_rw')->nullable();
            $table->string('jrk_terdekat')->nullable();
            $table->string('jrk_terjauh')->nullable();
            $table->string('polindes')->nullable();
            $table->string('pks_pembantu')->nullable();
            $table->string('pks')->nullable();
            $table->string('pkt_dokter')->nullable();
            $table->string('klinik')->nullable();
            $table->string('rumah_sakit')->nullable();
            $table->string('kelurahan_g')->nullable();
            $table->string('kecamatan_g')->nullable();
            $table->string('kabupaten_g')->nullable();
            $table->string('provinsi_g')->nullable();
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
        Schema::dropIfExists('tb_geografi');
    }
}
