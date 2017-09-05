<?php namespace App\Http\Controllers\Sistema\Reportes;

use App\Http\Requests;
use App\Kardex;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
class ReportesController extends Controller{

    private $campo, $res, $cond, $tabla;
    public function index_estudiante()
    {
        $usuarios = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
            ->join('estudiante as e', 'u.id', '=', 'e.id_user')
            ->join('curso as c', 'e.id_curso', '=', 'c.id')
            ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', 'kardex.ci', 'kardex.sexo', 'kardex.estado',
                'u.email', 'c.nombre')
            ->where('u.tipo_usuario', '=', '1')
            ->orderBy('ap_paterno', 'asc')
            ->get();
        return view('Sistema/Reportes/Vistas/RUsuarios', compact('usuarios'));
    }
    public function buscar()
    {
        $data = '';
        $var = Input::get('tipo');
        $name = Input::get('nombre');
        if($var == 'ap_paterno')
        {
            $data = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                ->join('curso as c', 'e.id_curso', '=', 'c.id')
                ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', 'kardex.ci', 'kardex.sexo', 'kardex.estado',
                    'u.email', 'c.nombre')
                ->where('u.tipo_usuario', '=', '1')
                ->where('kardex.ap_paterno', 'LIKE', $name . '%')
                ->orderBy('ap_paterno', 'asc')
                ->get();
        }
        if($var == 'ci')
        {
            $data = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                ->join('curso as c', 'e.id_curso', '=', 'c.id')
                ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', 'kardex.ci', 'kardex.sexo', 'kardex.estado',
                    'u.email', 'c.nombre')
                ->where('u.tipo_usuario', '=', '1')
                ->where('kardex.ci', 'LIKE', $name . '%')
                ->orderBy('ap_paterno', 'asc')
                ->get();
        }
        if($var == 'curso')
        {
            $data = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                ->join('curso as c', 'e.id_curso', '=', 'c.id')
                ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', 'kardex.ci', 'kardex.sexo', 'kardex.estado',
                    'u.email', 'c.nombre')
                ->where('u.tipo_usuario', '=', '1')
                ->where('c.nombre', 'LIKE', $name . '%')
                ->orderBy('ap_paterno', 'asc')
                ->get();
        }

        if($var == 'email')
        {
            $data = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                ->join('curso as c', 'e.id_curso', '=', 'c.id')
                ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', 'kardex.ci', 'kardex.sexo', 'kardex.estado',
                    'u.email', 'c.nombre')
                ->where('u.tipo_usuario', '=', '1')
                ->where('u.email', 'LIKE', $name . '%')
                ->orderBy('ap_paterno', 'asc')
                ->get();
        }
        $this->campo = $var;
        $this->res = $name;
        return Response::json($data);
    }
    public function pdf_estudiante(Request $request)
    {
        $ops = $request->request;
        $keys = array_values((array)$ops);
        $array_keys = array();
        $cont = count($request->request) - 3;
        $array = array();
        $i = 0;
        if($ops->get('reglas') == "? undefined:undefined ?" || $ops->get('buscar') == "")
        {
            $this->cond = '';
            $this->tabla = 'sexo';
        }
        else
        {
            $this->tabla = $ops->get('reglas');
            $this->cond = $ops->get('buscar');
        }
        foreach($ops as $t)
        {
            $array[$i] = $t;
            $i++;
        }
        $contador = count($keys[0]);
        $array_keys[1] = 'Nombres';
        $array_keys[2] = 'Apellidos Paterno';
        $array_keys[3] = 'Apellido Materno';
        $i = 4;
        foreach($keys[0] as $t)
        {
            $array_keys[$i] = $t;
            $i++;
        }
        unset($array_keys[$contador+1], $array_keys[$contador+2], $array_keys[$contador+3]);


        for($i=4;$i<=count($array_keys);$i++)
        {
            if($array_keys[$i] == 'kardex.ci')
            {
                $array_keys[$i] = 'CI';
            }
            if($array_keys[$i] == 'kardex.sexo')
            {
                $array_keys[$i] = 'Sexo';
            }
            if($array_keys[$i] == 'u.email')
            {
                $array_keys[$i] = 'Email';
            }
            if($array_keys[$i] == 'c.nombre')
            {
                $array_keys[$i] = 'Curso';
            }
        }
        switch ($cont) {
            case 1:
                $this->campo = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                    ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                    ->join('curso as c', 'e.id_curso', '=', 'c.id')
                    ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', $array[0])
                    ->where('u.tipo_usuario', '=', '1')
                    ->where($this->tabla, 'like', $this->cond . '%')
                    ->orderBy('ap_paterno', 'asc')
                    ->get();
                break;
            case 2:
                $this->campo = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                    ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                    ->join('curso as c', 'e.id_curso', '=', 'c.id')
                    ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', $array[0], $array[1])
                    ->where('u.tipo_usuario', '=', '1')
                    ->where($this->tabla, 'like', $this->cond . '%')
                    ->orderBy('ap_paterno', 'asc')
                    ->get();
                break;
            case 3:
                $this->campo = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                    ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                    ->join('curso as c', 'e.id_curso', '=', 'c.id')
                    ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', $array[0], $array[1], $array[2])
                    ->where('u.tipo_usuario', '=', '1')
                    ->where($this->tabla, 'like', $this->cond . '%')
                    ->orderBy('ap_paterno', 'asc')
                    ->get();
                break;
            case 4:
                $this->campo = Kardex::join('users as u', 'kardex.id', '=', 'u.id_kardex')
                    ->join('estudiante as e', 'u.id', '=', 'e.id_user')
                    ->join('curso as c', 'e.id_curso', '=', 'c.id')
                    ->select('kardex.nombres', 'kardex.ap_paterno', 'kardex.ap_materno', $array[0], $array[1], $array[2],
                        $array[3])
                    ->where('u.tipo_usuario', '=', '1')
                    ->where($this->tabla, 'like', $this->cond . '%')
                    ->orderBy('ap_paterno', 'asc')
                    ->get();
                break;
            default:
                break;
        }
        $arr = array();
        $ii = 0;
        $jj = 0;
        $p = $this->campo;
        foreach($p as $t)
        {
            foreach($t['attributes'] as $pp)
            {
                $arr[$ii][$jj] = $pp;
                $jj++;
            }
            $ii++;
            $jj = 0;
        }
        return $this->usuarios($arr, $array_keys);
    }
    public function usuarios($arr, $array_keys)
    {
        $view =  \View::make('Sistema.Reportes.Html.estudiantes', compact('arr', 'array_keys'))->render();
        $pdf = \App::make('dompdf.wrapper'); //Note: in 0.6.x this will be 'dompdf.wrapper'
        $pdf->loadHTML($view)->setPaper('letter')->setOrientation('landscape');
        $carbon = new Carbon;
        return $pdf->download('Reporte_Usuarios_'.$carbon->now(new \DateTimeZone('America/La_Paz'))->toDateTimeString().'.pdf');
    }

    public function excel_estudiante()
    {
        $carbon = new Carbon();
        Excel::create('Reporte_Usuarios_'.$carbon->now(new \DateTimeZone('America/La_Paz'))->toDateTimeString(), function($excel) {

            $excel->sheet('Productos', function($sheet) {

                $products = User::all();
                $sheet->fromArray($products);

            });
        })->export('xlsx');
    }

}