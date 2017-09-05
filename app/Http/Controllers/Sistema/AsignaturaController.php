<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 6/15/2016
 * Time: 3:21 p.m.
 */

namespace App\Http\Controllers\Sistema;


use App\Comentario;
use App\Http\Controllers\Controller;
use App\Asignacion;
use App\Asignatura;
use App\Curso;
use App\Http\Requests;
use App\Kardex;
use App\Publicacion;
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
class AsignaturaController extends Controller
{
    public function index($id)
    {
        $publicaciones = Publicacion::join('kardexes as k', 'publicaciones.id_user', '=', 'k.id_user')
            ->select('publicaciones.id','titulo', 'publicaciones.created_at as fecha', 'k.name as k_name', 'k.ap_patern as k_pat','categoria')
            ->where('id_asignatura', '=', $id)
            ->Orderby('fecha', 'desc')
            ->paginate(10);
        return view('Sistema/ListaPublicacion', compact('publicaciones', 'id'));
    }
    public function publicacion($id)
    {
        $comentarios = Comentario::join('kardexes as k', 'comentarios.id_user', '=', 'k.id_user')
            ->select('texto', 'comentarios.created_at as fecha', 'k.name as k_name', 'k.ap_patern as k_pat')
            ->where('id_publicacion', '=', $id)
            ->get();
        $publicacion = Publicacion::join('kardexes as k', 'publicaciones.id_user', '=', 'k.id_user')
            ->select('titulo', 'publicaciones.created_at as fecha', 'k.name as k_name', 'k.ap_patern as k_pat','categoria', 'video', 'rutaArchivo', 'texto')
            ->where('publicaciones.id', '=', $id)
            ->get();
        return view('Sistema/NuevaPublicacion', compact('publicacion', 'comentarios', 'id'));
    }
    public function save_comentario(Request $request)
    {
        $comen = new Comentario();
        $comen->texto = $request->texto;
        $comen->id_user = Auth::user()->id;
        $comen->id_asignatura = 1;
        $comen->id_publicacion = $request->trabajo_id;
        $comen->save();
        return redirect::back()->with(['success' => ' ']);
    }
    public function getPublicacion(Request $request)
    {
        //dd($request);
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $video = $request->video;
        //obtenemos el campo file definido en el formulario
        if ($request->file('archivo'))
        {
            $file = $request->file('archivo');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $url = $nombre;
            $messages = [
                'mimes' => 'Solo se permiten Archivos .pdf, .doc, .docx.',
            ];
            $validator = Validator::make(
                [
                    'titulo' => $titulo,
                    'file' => $file,
                    'nombre' => $nombre
                ],
                [
                    'titulo' => 'required|max:255',
                    'file' => 'mimes:doc,docx,pdf'
                ],
                $messages);
            $message = 'f';
            if ($validator->fails())
            {
                return redirect::back()->withErrors($validator);
            }
            //$carbon = new Carbon;
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));
        }
        else
        {
            $url = "";
        }

        $publicacion = new Publicacion();
        $publicacion->titulo        = $titulo;
        $publicacion->texto         = $descripcion;
        $publicacion->rutaArchivo   = $url;
        $publicacion->id_user       = Auth::user()->id;
        $publicacion->id_asignatura = $request->id;
        $publicacion->video         = $video;
        $publicacion->categoria     = $categoria;
        $publicacion->save();
        return redirect::back()->with(['success' => ' ']);
    }
}