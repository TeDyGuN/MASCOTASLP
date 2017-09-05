<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_asignatura')->unsigned()->nullable();
            $table->foreign('id_asignatura')->references('id')->on('asignaturas')->onDelete('Cascade');
            $table->integer('id_estudiante')->unsigned()->nullable();
            $table->foreign('id_estudiante')->references('id')->on('estudiantes')->onDelete('Cascade');
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
        Schema::drop('asignacions');
    }
}
