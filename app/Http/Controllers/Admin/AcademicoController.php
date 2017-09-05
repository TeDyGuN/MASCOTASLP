<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 10/29/2015
 * Time: 4:09 p.m.
 */

namespace App\Http\Controllers\Admin;



use App\Asignatura;
use App\Curso;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PhpParser\Comment\Doc;

class AcademicoController extends Controller
{

    public function materia()
    {
        $cursos = Curso::select('id', 'nombre')
            ->get();
        return view('Admin/Creacion/Asignatura', compact('cursos'));
    }
    public function save_materia(Request $request)
    {
        $m = new Asignatura();
        $m->nombre         = $request->nombres;
        $m->id_curso        = $request->curso;
        $m->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function asignar_docente()
    {

        $docentes = Kardex::join('users as u', 'id_user', '=', 'u.id')
            ->select('u.id','name', 'ap_patern', 'ap_mother')
            ->where('user_type', '=', '2')
            ->get();
        $materias = Asignatura::select('id', 'nombre')
            ->orderBy('nombre', 'asc')
            ->get();
        $no_asignadas = Asignatura::join('cursos as c', 'id_curso', '=', 'c.id')
            ->select('c.nombre as cnombre', 'asignaturas.nombre')
            ->where('id_docente','=', null)
            ->get();
        return view('Admin/AsignarDocente', compact('docentes', 'materias', 'no_asignadas'));
    }

    public function save_asignar(Request $request)
    {
        $m = Asignatura::find($request->materia);
        $m->id_docente = $request->docente;
        $m->save();
        return Redirect::back()->with(['success' => ' ']);
    }
}