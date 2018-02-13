<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargagandolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargagandola', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('peso_neto');
            $table->integer('id_gandola')->unsigned()->nullable();
            $table->foreign('id_gandola')->references('id')->on('gandola')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargagandola');
    }
}
