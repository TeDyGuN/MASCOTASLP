<?php
namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Validator;

class FullCalendarController extends Controller{

    public $arrayEventos;
    public function calendarevents(Request $request)
    {
        $json = json_encode($request->only('fechas'));
        $json = substr($json, 10, -1);
        $json1 = json_decode($json);
        $json2 = json_decode($json1);
        $this->arrayEventos = $json2;
        $n = count($json2);
        Event::where('user_id', '=', Auth::user()->id)->delete();
        for($i = 0; $i < $n; $i++)
        {
            $json2[$i]->start = substr($json2[$i]->start, 0, -5);
            if($json2[$i]->backcolor != 'white')
            {
                Event::create([
                    'titulo_evento'         => $json2[$i]->titulo,
                    'start'                 => $json2[$i]->start,
                    'backgroundColor'       => $json2[$i]->backcolor,
                    'borderColor'           => $json2[$i]->bordecolor,
                    'allDay'                => $json2[$i]->allday,
                    'id_eventoCallendar'    => $json2[$i]->id,
                    'user_id'               => Auth::user()->id
                ]);
            }
        }
        return Redirect::action('Calendar\FullCalendarController@getCalendar');
    }
    public function getCalendar()
    {
        $eventos =  Event::select('titulo_evento')
            ->where('user_id', '=', Auth::user()->id)
            ->take(4)
            ->get();
        //$datos['cTrabajo']= \DB::table('trabajo')->count();

        $array = Event::where('user_id', '=', Auth::user()->id)->get();
        return view('Calendar/calendar', compact('array','datos','eventos'));
    }
    public function buscar()
    {
        $name = Input::get('nombre');
        $usuarios = User::where('father_last_name', 'LIKE', '%' . $name . '%')->take(3)->get();
        return Response::json($usuarios);
    }
    public function getModified(Request $request)
    {
        /*
         * "descripcion" => "jog"
          "tutor-on" => "on"
          "cursante-on" => "on"
          "tutor" => "Dan Kub"
          "idtutor" => "8"
          "idevento" => "1"
         */
        $evento = Event::find($request->idevento);
        $evento->descripcion = $request->descripcion;
        $evento->save();
        if($request->tutor_on)
        {
            $usuarios = User::where('type', '=', 'Tutor')->get();
            foreach($usuarios as $usuario)
            {
                $nuevo_evento = new Event;
                $nuevo_evento->titulo_evento        = $evento->titulo_evento;
                $nuevo_evento->start                = $evento->start;
                $nuevo_evento->backgroundColor      = $evento->backgroundColor;
                $nuevo_evento->borderColor          = $evento->borderColor;
                $nuevo_evento->allDay               = $evento->allDay;
                $nuevo_evento->id_eventoCallendar   = $evento->id_eventoCallendar;
                $nuevo_evento->descripcion          = $evento->descripcion;
                $nuevo_evento->user_id              = $usuario->id;
                $nuevo_evento->save();
            }
        }
        if($request->cursante_on)
        {
            $usuarios = User::where('type', '=', 'Cursante')->get();
            foreach($usuarios as $usuario)
            {
                $nuevo_evento = new Event;
                $nuevo_evento->titulo_evento        = $evento->titulo_evento;
                $nuevo_evento->start                = $evento->start;
                $nuevo_evento->backgroundColor      = $evento->backgroundColor;
                $nuevo_evento->borderColor          = $evento->borderColor;
                $nuevo_evento->allDay               = $evento->allDay;
                $nuevo_evento->id_eventoCallendar   = $evento->id_eventoCallendar;
                $nuevo_evento->descripcion          = $evento->descripcion;
                $nuevo_evento->user_id              = $usuario->id;
                $nuevo_evento->save();
            }
        }
        if($request->tutor != "")
        {
            $usuario = User::find($request->idtutor);
            $nombre = $usuario->first_name.' '.$usuario->father_last_name;
            if($nombre == $request->tutor)
            {
                $nuevo_evento = new Event;
                $nuevo_evento->titulo_evento        = $evento->titulo_evento;
                $nuevo_evento->start                = $evento->start;
                $nuevo_evento->backgroundColor      = $evento->backgroundColor;
                $nuevo_evento->borderColor          = $evento->borderColor;
                $nuevo_evento->allDay               = $evento->allDay;
                $nuevo_evento->id_eventoCallendar   = $evento->id_eventoCallendar;
                $nuevo_evento->descripcion          = $evento->descripcion;
                $nuevo_evento->user_id              = $usuario->id;
                $nuevo_evento->save();
            }
        }
        return redirect('calendar/calendar');
    }
}