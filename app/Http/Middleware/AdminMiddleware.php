<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


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
                break;
            case 2:
                return redirect()->to('Docente');
                break;
            default:
                return redirect()->to('login');
                break;
        }
        return $next($request);
    }
}
