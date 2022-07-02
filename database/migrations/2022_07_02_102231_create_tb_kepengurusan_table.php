<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKepengurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kepengurusan', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('ket_m')->nullable();
            $table->string('bend_m')->nullable();
            $table->string('sek_m')->nullable();
            $table->string('ket_kkp')->nullable();
            $table->string('bend_kkp')->nullable();
            $table->string('sek_kkp')->nullable();
            $table->string('ket_kkb')->nullable();
            $table->string('bend_kkb')->nullable();
            $table->string('sek_kkb')->nullable();
            $table->string('ket_kkbp')->nullable();
            $table->string('bend_kkbp')->nullable();
            $table->string('sek_kkbp')->nullable();
            $table->string('ket_kkbe')->nullable();
            $table->string('bend_kkbe')->nullable();
            $table->string('sek_kkbe')->nullable();
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
        Schema::dropIfExists('tb_kepengurusan');
    }
}
