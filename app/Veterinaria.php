<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinaria extends Model
{
	public $table = 'veterinarias';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	/*
	 * $table->increments('id');
            $table->string('Nombre');
	        $table->string('Direccion');
	        $table->string('Telefono');
	        $table->text('Servicios');
	        $table->string('Venta');
	*/
	protected $fillable = ['id', 'Nombre', 'Direccion', 'Telefono', 'Servicios', 'Venta'];
}
