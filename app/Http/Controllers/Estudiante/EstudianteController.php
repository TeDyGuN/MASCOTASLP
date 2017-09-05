<?php namespace App\Http\Controllers\Estudiante;

use App\Asignacion;
use App\Asignatura;
use App\Curso;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class EstudianteController extends Controller{
    public function index()
    {
        $materias = Asignacion::join('asignaturas as a', 'id_asignatura', '=', 'a.id')
            ->join('cursos as c', 'a.id_curso', '=', 'c.id')
            ->select('c.nombre as cnombre', 'a.nombre as nombre', 'a.id')
            ->where('id_estudiante','=', Auth::user()->id_est())
        ->get();
        /*$materias = Asignatura::join('cursos as c', 'id_curso', '=', 'c.id')
            ->select('c.nombre as cnombre', 'asignaturas.nombre', 'asignaturas.id')
            ->where('id_docente','=', Auth::user()->id)
            ->get();*/
        return view('Estudiante/index', compact('materias'));
    }

}