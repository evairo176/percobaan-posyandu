<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_program', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('paud')->nullable();
            $table->string('bkb')->nullable();
            $table->string('bkr')->nullable();
            $table->string('bkl')->nullable();
            $table->string('up2k')->nullable();
            $table->string('as')->nullable();
            $table->string('in')->nullable();
            $table->string('ds')->nullable();
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
        Schema::dropIfExists('tb_program');
    }
}
