<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kader', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('nama_kader')->nullable();
            $table->date('umur')->nullable();
            $table->year('tahun_jadi_kader')->nullable();
            $table->string('pendidikan')->nullable();
            $table->year('tahun_pelatihan')->nullable();
            $table->string('no_hp')->nullable();
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
        Schema::dropIfExists('tb_kader');
    }
}
