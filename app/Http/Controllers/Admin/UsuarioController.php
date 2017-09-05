<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 10/29/2015
 * Time: 4:09 p.m.
 */

namespace App\Http\Controllers\Admin;



use App\Asignacion;
use App\Asignatura;
use App\Curso;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\User;

use App\Estudiante;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;

use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class UsuarioController extends Controller
{
    public $subir;
    public function admin()
    {
        return view('Admin/Creacion/Administrador');
    }
    public function save_admin(Request $request)
    {
        /*
         * $table->increments('id');
            $table->string('name');
            $table->string('ap_patern');
            $table->string('ap_mother');
            $table->string('ci', 8)->unique();
            $table->boolean('sex');
            $table->integer('user_type');
            $table->integer('id_user')->unsigned()->nullable();
         *
         * */
        $k = new Kardex;
        $k->name          = $request->nombres;
        $k->ap_patern     = $request->father;
        $k->ap_mother     = $request->mother;
        $k->ci            = $request->ci;
        $k->sex           = $request->sexo;
        $k->user_type     = 1;
        $k->save();

        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 1;
        $u->save();

        $us_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $ka_id = Kardex::select('id')
            ->where('ci', '=', $request->ci)
            ->get();

        $ka = Kardex::find($ka_id[0]->id);
        $ka->id_user    = $us_id[0]->id;
        $ka->save();

        return Redirect::back()->with(['success' => ' ']);
    }
    public function docente()
    {
        return view('Admin/Creacion/Docente');
    }
    public function save_docente(Request $request)
    {
        $k = new Kardex;
        $k->name          = $request->nombres;
        $k->ap_patern     = $request->father;
        $k->ap_mother     = $request->mother;
        $k->ci            = $request->ci;
        $k->sex           = $request->sexo;
        $k->user_type     = 2;
        $k->save();

        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 2;
        $u->save();

        $us_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $ka_id = Kardex::select('id')
            ->where('ci', '=', $request->ci)
            ->get();

        $ka = Kardex::find($ka_id[0]->id);
        $ka->id_user    = $us_id[0]->id;
        $ka->save();

        return Redirect::back()->with(['success' => ' ']);
    }
    public function estudiante()
    {
        return view('Admin/Creacion/Estudiante');
    }
    public function masivo()
    {
        return view('Admin/Creacion/UsuariosExcel');
    }
    public function getExcel()
    {
        Excel::load('Estudiantes.xlsx', function($doc) {
        })->download('xlsx');

    }

    public function subir_plantilla(Request $request)
    {
        set_time_limit(5000);
        $this->subir = $request;
        //obtenemos el campo file definido en el formulario
        $file = $request->file('archivo');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        $url = storage_path('app/').$nombre;
        $messages = [
            'mimes' => 'Solo se permiten Archivos Excel .xls, .xlsx',
        ];
        $validator = Validator::make(
            [
                'file' => $file,
                'nombre' => $nombre
            ],
            [
                'file' => 'mimes:xls,xlsx'
            ],
            $messages);
        $message = 'f';
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        \Storage::disk('local')->put($nombre,  \File::get($file));
        Excel::load($url, function($reader) {
            $results = $reader->get();
            //dd($results);
            for ($i = 0; $i < $this->subir->numero; $i++) {
                $k = new Kardex;
                $k->name          = $results[$i]['nombre'];
                $k->ap_patern     = $results[$i]['ap_paterno'];
                $k->ap_mother     = $results[$i]['ap_materno'];
                $k->ci            = $results[$i]['ci'];
                if($results[$i]['genero'] == 'M')
                {
                    $k->sex           = 1;
                }
                else
                {
                    $k->sex           = 0;
                }
                $k->user_type     = 3;
                $k->save();

                $u = new User;
                $u->email            = $results[$i]['email'];
                $u->password         = \Hash::make($results[$i]['ci']);
                $u->tipo_usuario     = 3;
                $u->save();

                $us_id = User::select('id')
                    ->where('email', '=', $results[$i]['email'])
                    ->get();
                $ka_id = Kardex::select('id')
                    ->where('ci', '=', $results[$i]['ci'])
                    ->get();

                $ka = Kardex::find($ka_id[0]->id);
                $ka->id_user    = $us_id[0]->id;
                $ka->save();

                $e = new Estudiante();
                $e->id_curso    = $results[$i]['curso'];
                $e->id_user     = $us_id[0]->id;
                $e->save();

                $as = Asignatura::join('cursos as c', 'id_curso', '=', 'c.id')
                    ->join('estudiantes as e', 'c.id', '=', 'e.id_curso')
                    ->select('asignaturas.id', 'e.id as e_id')
                    ->where('e.id_user', '=', $us_id[0]->id)
                    ->get();
                foreach($as as $a)
                {
                    $asig = New Asignacion();
                    $asig->id_asignatura = $a->id;
                    $asig->id_estudiante = $a->e_id;
                    $asig->save();
                }
            }
        });
        return Redirect::back()->with(['success' => ' ']);
    }
    public function modificar(Request $request)
    {
        $user = User::find($request->_idUser);
        $ka_id = Kardex::select('id')
            ->where('id_user', '=', $user->id)
            ->get();
        $kardex = Kardex::find($ka_id[0]->id);
        return $this->retornar($kardex);
    }
    public function retornar($kardex)
    {
        return view('Admin/Creacion/Modificar', compact('kardex'));
    }
    public function save_modificar(Request $request)
    {
        $kardex = Kardex::find($request->id);
        $kardex->name    = $request->nombres;
        $kardex->ap_patern       = $request->father;
        $kardex->ap_mother       = $request->mother;
        $kardex->ci               = $request->ci;
        $kardex->save();

        return redirect()->route('Admin.users.index');
    }
    public function save_estudiante(Request $request)
    {
        $k = new Kardex;
        $k->name          = $request->nombres;
        $k->ap_patern     = $request->father;
        $k->ap_mother     = $request->mother;
        $k->ci            = $request->ci;
        $k->sex           = $request->sexo;
        $k->user_type     = 3;
        $k->save();

        $u = new User;
        $u->email            = $request->email;
        $u->password         = \Hash::make($request->ci);
        $u->tipo_usuario     = 3;
        $u->save();

        $us_id = User::select('id')
            ->where('email', '=', $request->email)
            ->get();
        $ka_id = Kardex::select('id')
            ->where('ci', '=', $request->ci)
            ->get();

        $ka = Kardex::find($ka_id[0]->id);
        $ka->id_user    = $us_id[0]->id;
        $ka->save();

        $e = new Estudiante();
        $e->id_curso    = $request->curso;
        $e->id_user     = $us_id[0]->id;
        $e->save();

        $as = Asignatura::join('cursos as c', 'id_curso', '=', 'c.id')
            ->join('estudiantes as e', 'c.id', '=', 'e.id_curso')
            ->select('asignaturas.id', 'e.id as e_id')
            ->where('e.id_user', '=', $us_id[0]->id)
            ->get();
        foreach($as as $a)
        {
            $asig = New Asignacion();
            $asig->id_asignatura = $a->id;
            $asig->id_estudiante = $a->e_id;
            $asig->save();
        }

	    return Redirect::back()->with(['success' => ' ']);
    }
}