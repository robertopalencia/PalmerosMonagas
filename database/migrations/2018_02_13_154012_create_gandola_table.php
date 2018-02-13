<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGandolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gandola', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('placa');
            $table->string('chofer');
            $table->integer('cedula');
            $table->integer('peso');
            $table->string('telefono');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gandola');
    }
}
