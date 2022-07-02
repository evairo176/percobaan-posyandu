<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPembentukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembentukan', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('tgl_musyawarah')->nullable();
            $table->string('psr_musyawarah')->nullable();
            $table->string('mtr_musyawarah')->nullable();
            $table->text('ksp_musyawarah')->nullable();
            $table->string('lurah')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tgl')->nullable();
            $table->string('tentang')->nullable();
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
        Schema::dropIfExists('tb_pembentukan');
    }
}
