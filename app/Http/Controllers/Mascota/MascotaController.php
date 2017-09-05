<?php namespace App\Http\Controllers\Mascota;

use App\Asignacion;
use App\Asignatura;
use App\Codigo;
use App\Curso;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mascota;
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

class MascotaController extends Controller{

	public function getViewSave()
	{

		$codigo = Codigo::where('uso', '=', false)
			->take(1)
			->get();
		return view('Mascota/registro', compact('codigo'));
	}
	public function saveMascota(Request $request)
	{
		$idc = Codigo::select('id', 'codigo')
			->where('codigo', $request->codigo)
			->take(1)
			->get();
		$mascota = new Mascota();
		$mascota->dnombre = $request->nombres;
		$mascota->dapellido = $request->father;
		$mascota->demail = $request->email;
		$mascota->dci = $request->ci;
		$mascota->direccion = $request->direccion;
		$mascota->dtelefono = $request->telefono;
		$mascota->dcelular = $request->celular;
		$mascota->mnombre = $request->nombrem;
		$mascota->mraza = $request->raza;
		$mascota->mcolor = $request->color;
		$mascota->mpeso = $request->peso;
		$mascota->motros = $request->otros;
		$mascota->id_codigo = $idc[0]['id'];
		$mascota->codigo = $idc[0]['codigo'];
		$mascota->save();
		$codigo = Codigo::find(1);
		$codigo->uso = true;
		$codigo->save();
		return Redirect::back()->with(['success' => ' ']);
	}
}