<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        else{
            if(Auth::user()->tipo_usuario == 1)
            {
                return redirect()->to('Admin');
            }
            elseif(Auth::user()->tipo_usuario == 2)
            {
                return redirect()->to('Docente');
            }
            elseif(Auth::user()->tipo_usuario == 3)
            {
                return redirect()->to('Estudiante');
            }
        }
        return $next($request);
    }
}
