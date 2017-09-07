<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veterinarias', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('Nombre');
	        $table->string('Direccion');
	        $table->string('Telefono');
	        $table->text('Servicios');
	        $table->string('Venta');
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
        Schema::drop('veterinarias');
    }
}
