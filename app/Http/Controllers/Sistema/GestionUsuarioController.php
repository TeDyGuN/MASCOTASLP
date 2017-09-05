<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kardex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionUsuarioController extends Controller
{
    public function index()
    {
        $tipo = Auth::user()->tipo();
        switch($tipo){
            case "Administrador":
                $users = User::paginate();
                break;
            case "Director":
                $users = User::where('tipo_usuario', '<>', '3')
                    ->where('tipo_usuario', '<>', '4')
                    ->paginate();
                break;
            case "Secretaria":
                $users = User::where('tipo_usuario', '<>', '3')
                    ->where('tipo_usuario', '<>', '4')
                    ->where('tipo_usuario', '<>', '5')
                    ->paginate();


        }
        return view('Sistema.ModificarU', compact('users'));
    }
    public function save()
    {


    }
    public function create($kardex, $email)
    {
    }
    public function store()
    {

    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update($id)
    {

    }
    public function destroy($id)
    {
        $user = User::find($id);
        $kardex = Kardex::find($user->id_kardex);
        $kardex->estado = 0;
        $kardex->save();
        $message = $user->apellido().' fue desactivado de nuestros registros';
        return $message;
    }
}
