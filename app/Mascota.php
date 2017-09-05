<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
	public $table = 'mascotas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	/*
	 * $table->increments('id');
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
	        $table->integer('id_codigo')->unsigned();
	        $table->foreign('id_codigo')->references('id')->on('codigo');
            $table->timestamps();
	 * */
	protected $fillable = ['id', 'dnombre', 'dapellido', 'demail', 'dci', 'direccion', 'dtelefono', 'dcelular', 'mnombre'
		, 'mraza', 'mcolor', 'mpeso', 'motros', 'id_codigo'];
}
