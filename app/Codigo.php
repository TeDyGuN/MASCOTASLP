<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
	public $table = 'codigos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'codigo', 'uso'];
}
