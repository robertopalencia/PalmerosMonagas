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
            $table->string('placaremolque');
            $table->string('modelo');
            $table->string('marca');
            $table->string('color');
            $table->integer('ano');
            $table->string('chofer');
            $table->string('cedula');
            $table->decimal('peso', 10, 2);
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
