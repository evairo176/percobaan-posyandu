<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKegiatanUtamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kegiatan_utama', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('vit_a')->nullable();
            $table->string('kb_aktif')->nullable();
            $table->string('k4')->nullable();
            $table->string('fe3')->nullable();
            $table->string('campak')->nullable();
            $table->string('bcg')->nullable();
            $table->string('dpt')->nullable();
            $table->string('hbo')->nullable();
            $table->string('polio')->nullable();
            $table->string('gizi')->nullable();
            $table->string('diare')->nullable();
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
        Schema::dropIfExists('tb_kegiatan_utama');
    }
}
