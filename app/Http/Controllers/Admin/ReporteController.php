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

class ReporteController extends Controller
{
	public function getUsers(){
		$codigo = Codigo::where('uso', '=', false)
		                ->take(1)
		                ->get();
		return view('Reporte/users', compact('codigo'));
	}

}