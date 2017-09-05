<?php namespace App\Http\Controllers\Docente;
use App\Asignacion;
use App\Asignatura;
use App\Curso;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Materia;
use App\Nota;
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
class DocenteController extends Controller{

    public function index()
    {
        $materias = Asignatura::join('cursos as c', 'id_curso', '=', 'c.id')
            ->select('c.nombre as cnombre', 'asignaturas.nombre', 'asignaturas.id')
            ->where('id_docente','=', Auth::user()->id)
            ->get();
        return view('Docente/index',compact('materias'));
    }

}