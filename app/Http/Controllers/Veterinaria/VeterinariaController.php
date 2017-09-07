<?php namespace App\Http\Controllers\Veterinaria;

use App\Asignacion;
use App\Asignatura;
use App\Codigo;
use App\Curso;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Veterinaria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VeterinariaController extends Controller{

	public function getViewSave()
	{

//		$codigo = Codigo::where('uso', '=', false)
//			->take(1)
//			->get();
		return view('Veterinaria/registro');
	}
	public function saveVeterinaria(Request $request)
	{

		/*protected $fillable = ['id', 'Nombre', 'Direccion', 'Telefono', 'Servicios', 'Venta'];*/
		$mascota = new Veterinaria();
		$mascota->Nombre = $request->nombre;
		$mascota->Direccion = $request->direccion;
		$mascota->Telefono = $request->telefono;
		$mascota->Servicios = $request->servicios;
		$mascota->Venta = $request->venta;
		$mascota->save();
		return Redirect::back()->with(['success' => ' ']);
	}
}