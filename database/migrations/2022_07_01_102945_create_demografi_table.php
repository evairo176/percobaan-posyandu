<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemografiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_demografi', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('jml_kpl_klg')->nullable();
            $table->string('jml_pdd')->nullable();
            $table->string('jml_pdd_l')->nullable();
            $table->string('jml_pdd_p')->nullable();
            $table->string('jml_pus')->nullable();
            $table->string('jml_wus')->nullable();
            $table->string('jml_ibu_hml')->nullable();
            $table->string('jml_bayi_d')->nullable();
            $table->string('jml_balita_d')->nullable();
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
        Schema::dropIfExists('demografi');
    }
}
