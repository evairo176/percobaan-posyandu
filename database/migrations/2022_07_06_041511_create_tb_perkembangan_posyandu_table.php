<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPerkembanganPosyanduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_perkembangan_posyandu', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->integer('kelurahan_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->string('pra')->nullable();
            $table->string('mad')->nullable();
            $table->string('pur')->nullable();
            $table->string('man')->nullable();
            $table->string('jml_bgn')->nullable();
            $table->string('jml_kader')->nullable();
            $table->string('jml_terlatih')->nullable();
            $table->string('s')->nullable();
            $table->string('k')->nullable();
            $table->string('d')->nullable();
            $table->string('n')->nullable();
            $table->string('vit-a')->nullable();
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
            $table->string('paud')->nullable();
            $table->string('bkb')->nullable();
            $table->string('bkr')->nullable();
            $table->string('bkl')->nullable();
            $table->string('up2k')->nullable();
            $table->string('as')->nullable();
            $table->string('ingklusi')->nullable();
            $table->string('dana_sehat')->nullable();
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
        Schema::dropIfExists('tb_perkembangan_posyandu');
    }
}
