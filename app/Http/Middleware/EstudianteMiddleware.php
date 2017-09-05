<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EstudianteMiddleware
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * 1-ADMIN
         * 2-DOCENTE
         * 3-ENCARGADO-CURSO
         * 4-ESTUDIANTE
         *
         * */
        switch($this->auth->user()->tipo_usuario)
        {
            case 1:
                return redirect()->to('Admin');
                break;
            case 2:
                return redirect()->to('Docente');
                break;
            case 3:
                break;
            default:
                return redirect()->to('login');
                break;
        }
        return $next($request);
    }
}
