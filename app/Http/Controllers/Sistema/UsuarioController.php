<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 10/29/2015
 * Time: 4:09 p.m.
 */

namespace App\Http\Controllers\Sistema;


use App\Admin;
use App\Director;
use App\Estudiante;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\Docente;
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

class UsuarioController extends Controller
{
    public function director()
    {
        return view('Sistema/Creacion/Director');
    }
    public function save_director(Request $request)
    {
        $k = new Kardex;
        $k->nombres          = $request->nombres;
        $k->ap_paterno       = $request->father;
        $k->ap_materno       = $request->mother;
        $k->ci               = $request->ci;
        $k->sexo             = $request->sexo;
        $k->estado           = 1;
        $k->save();

        $user_id = Kardex::select('id')
            ->where('ci','=',$request->ci)
            ->get();
        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 4;
        $u->id_kardex        = $user_id[0]->id;
        $u->save();

        $st_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $e = new Director();
        $e->antiguedad    = $request->ant;
        $e->id_user     = $st_id[0]->id;
        $e->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function secretaria()
    {
        return view('Sistema/Creacion/Secretaria');
    }
    public function save_secre(Request $request)
    {
        $k = new Kardex;
        $k->nombres          = $request->nombres;
        $k->ap_paterno       = $request->father;
        $k->ap_materno       = $request->mother;
        $k->ci               = $request->ci;
        $k->sexo             = $request->sexo;
        $k->estado           = 1;
        $k->save();

        $user_id = Kardex::select('id')
            ->where('ci','=',$request->ci)
            ->get();
        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 5;
        $u->id_kardex        = $user_id[0]->id;
        $u->save();

        $st_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $e = new Secretaria();
        $e->antiguedad    = $request->ant;
        $e->id_user     = $st_id[0]->id;
        $e->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function admin()
    {
        return view('Sistema/Creacion/Administrador');
    }
    public function save_admin(Request $request)
    {
        $k = new Kardex;
        $k->nombres          = $request->nombres;
        $k->ap_paterno       = $request->father;
        $k->ap_materno       = $request->mother;
        $k->ci               = $request->ci;
        $k->sexo             = $request->sexo;
        $k->estado           = 1;
        $k->save();

        $user_id = Kardex::select('id')
            ->where('ci','=',$request->ci)
            ->get();
        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 3;
        $u->id_kardex        = $user_id[0]->id;
        $u->save();

        $st_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $e = new Admin();
        $e->antiguedad    = $request->ant;
        $e->id_user     = $st_id[0]->id;
        $e->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function docente()
    {
        return view('Sistema/Creacion/Docente');
    }
    public function save_docente(Request $request)
    {
        $k = new Kardex;
        $k->nombres          = $request->nombres;
        $k->ap_paterno       = $request->father;
        $k->ap_materno       = $request->mother;
        $k->ci               = $request->ci;
        $k->sexo             = $request->sexo;
        $k->estado           = 1;
        $k->save();

        $user_id = Kardex::select('id')
            ->where('ci','=',$request->ci)
            ->get();
        $u = new User();
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 2;
        $u->id_kardex        = $user_id[0]->id;
        $u->save();

        $st_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $e = new Docente();
        $e->antiguedad    = $request->ant;
        $e->id_user     = $st_id[0]->id;
        $e->save();
        return Redirect::back()->with(['success' => ' ']);
    }
    public function estudiante()
    {
        return view('Sistema/Creacion/Estudiante');
    }
    public function modificar(Request $request)
    {
        $user = User::find($request->_idUser);
        $email = $user->email;
        $idkardex = $user->id_kardex;
        $kardex = Kardex::find($idkardex);
        return $this->retornar($kardex, $email);
    }
    public function retornar($kardex, $email)
    {
        return view('Sistema/Creacion/Modificar', compact('kardex', 'email'));
    }
    public function save_modificar(Request $request)
    {
        $kardex = Kardex::find($request->id);
        $kardex->nombres    = $request->nombres;
        $kardex->ap_paterno       = $request->father;
        $kardex->ap_materno       = $request->mother;
        $kardex->ci               = $request->ci;
        $kardex->save();


        $user = User::where('id_kardex','=', $request->id)
            ->get();
        $u = User::find($user[0]->id);
        $u->email              = $request->email;
        $u->save();
        return redirect()->route('sistema.users.index');
    }
    public function save_estudiante(Request $request)
    {
        $k = new Kardex;
        $k->nombres          = $request->nombres;
        $k->ap_paterno       = $request->father;
        $k->ap_materno       = $request->mother;
        $k->ci               = $request->ci;
        $k->sexo             = $request->sexo;
        $k->estado           = 1;
        $k->save();

        $user_id = Kardex::select('id')
            ->where('ci','=',$request->ci)
            ->get();
        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 1;
        $u->id_kardex        = $user_id[0]->id;
        $u->save();

        $st_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $e = new Estudiante();
        $e->id_curso    = $request->curso;
        $e->id_user     = $st_id[0]->id;
        $e->save();
        return Redirect::back()->with(['success' => ' ']);
    }
}