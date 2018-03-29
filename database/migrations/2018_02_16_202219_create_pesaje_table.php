<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesaje', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('carga', 10, 2);
            $table->string('descripcion');
            $table->string('pago');
            $table->decimal('peso', 10, 2);
            $table->decimal('descuento', 10, 2);
            $table->date('fecha');
            $table->integer('precio');
            $table->integer('camion_id')->unsigned()->nullable();
            $table->foreign('camion_id')->references('id')->on('camion')->onDelete('set null');
            $table->integer('productor_id')->unsigned();
            $table->foreign('productor_id')->references('id')->on('productor')->onDelete('cascade');
            $table->integer('precio_id')->unsigned();
            $table->foreign('precio_id')->references('id')->on('precio');
            $table->integer('cargagandola_id')->unsigned();
            $table->foreign('cargagandola_id')->references('id')->on('cargagandola');
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
        Schema::dropIfExists('pesaje');
    }
}
