<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dnombre');
	        $table->string('dapellido');
	        $table->string('demail');
	        $table->string('dci');
	        $table->string('direccion');
	        $table->string('dtelefono');
	        $table->string('dcelular');
	        $table->string('mnombre');
	        $table->string('mraza');
	        $table->string('mcolor');
	        $table->string('mpeso');
	        $table->string('motros');
	        $table->string('codigo');
	        $table->integer('id_codigo')->unsigned();
	        $table->foreign('id_codigo')->references('id')->on('codigos');
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
        Schema::drop('mascotas');
    }
}
