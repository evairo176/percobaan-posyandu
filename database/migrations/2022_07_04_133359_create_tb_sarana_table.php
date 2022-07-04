<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sarana', function (Blueprint $table) {
            $table->id();
            $table->integer('posyandu_id')->nullable();
            $table->string('status_g')->nullable();
            $table->string('th_bgn_g')->nullable();
            $table->string('keadaan_g')->nullable();
            $table->string('luas_g')->nullable();
            $table->string('konstruksi_g')->nullable();
            $table->string('sdp_g')->nullable();
            $table->string('dacin_k')->nullable();
            $table->string('tb_k')->nullable();
            $table->string('ti_k')->nullable();
            $table->string('pl_k')->nullable();
            $table->string('autb_k')->nullable();
            $table->string('aupb_k')->nullable();
            $table->string('ape_k')->nullable();
            $table->string('sp_k')->nullable();
            $table->string('fm_k')->nullable();
            $table->string('m_k')->nullable();
            $table->string('pn_k')->nullable();
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
        Schema::dropIfExists('tb_sarana');
    }
}
