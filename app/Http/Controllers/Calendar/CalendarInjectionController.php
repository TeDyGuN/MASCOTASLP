<?php
/**
 * Created by PhpStorm.
 * User: TedyPc
 * Date: 07/10/2015
 * Time: 11:40
 */

namespace App\Http\Controllers\Calendar;
use App\Http\Controllers\Controller;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CalendarInjectionController
{
    public  function  getNumberEvents()
    {
        $number_Events = Event::where('user_id', '=', Auth::user()->id)
            ->count();
        return $number_Events;
    }
    public function getTittlesEvents()
    {
        $eventos =  Event::select('titulo_evento')
            ->where('user_id', '=', Auth::user()->id)
            ->take(4)
            ->get();
        return $eventos;
    }
}