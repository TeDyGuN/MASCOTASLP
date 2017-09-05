<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 10/29/2015
 * Time: 4:09 p.m.
 */

namespace App\Http\Controllers\Sistema;


use App\Admin;
use App\Aula;
use App\Curso;
use App\Director;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Docente;
use App\Materia;
use App\Secretaria;
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
    public function curso()
    {
        $aulas = Aula::select('id', 'nombre')
                    ->get();
        return view('Sistema/Creacion/Curso', compact('aulas'));
    }
    public function save_curso(Request $request)
    {
        $c = new Curso();
        $c->nombre           = $request->nombres;
        $c->id_aula          = $request->aula;
        $c->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function materia()
    {
        $cursos = Curso::select('id', 'nombre')
            ->get();
        return view('Sistema/Creacion/Materia', compact('cursos'));
    }
    public function save_materia(Request $request)
    {
        $m = new Materia();
        $m->asignatura      = $request->nombres;
        $m->sigla           = $request->sigla;
        $m->id_curso        = $request->curso;
        $m->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function aula()
    {
        return view('Sistema/Creacion/Aula');
    }
    public function save_aula(Request $request)
    {
        $a = new Aula();
        $a->nombre           = $request->nombres;
        $a->save();
        return Redirect::back()->with(['success' => ' ']);
    }

    public function asignar_docente()
    {
        $docentes = Docente::join('users as u', 'id_user', '=', 'u.id')
            ->join('kardex as k', 'u.id_kardex', '=', 'k.id')
            ->select('docente.id','k.nombres', 'k.ap_paterno', 'k.ap_materno')
            ->where('k.estado', '=', '1')
            ->get();
        $materias = Materia::select('id', 'asignatura')
            ->get();
        $no_asignadas = Materia::join('curso as c', 'id_curso', '=', 'c.id')
            ->select('c.nombre as cnombre', 'asignatura', 'sigla')
            ->where('id_docente','=', null)
            ->get();
        return view('Sistema/AsignarDocente', compact('docentes', 'materias', 'no_asignadas'));
    }

    public function save_asignar(Request $request)
    {
        $m = Materia::find($request->materia);
        $m->id_docente = $request->docente;
        $m->save();
        return Redirect::back()->with(['success' => ' ']);
    }
}