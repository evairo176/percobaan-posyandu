<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbStrataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_strata', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('pra')->nullable();
            $table->string('mad')->nullable();
            $table->string('pur')->nullable();
            $table->string('man')->nullable();
            $table->string('jml_bgn_s')->nullable();
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
        Schema::dropIfExists('tb_strata');
    }
}
