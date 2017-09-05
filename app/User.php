<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'tipo_usuario', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function apellido()
    {
        $datos = Kardex::select('name', 'ap_patern')
            ->where('id_user', '=', $this->id)
            ->get();
        return $datos[0]->name.' '.$datos[0]->ap_patern;
    }
    public function tipo()
    {
        switch ($this->tipo_usuario)
        {
            case 3:
                return 'Usuario';
            case 2:
                return 'Empleado';
            case 1:
                return 'Administrador';
        }
    }
    public function ci()
    {
        $datos = Kardex::select('ci')
            ->where('id_user', '=', $this->id)
            ->get();
        return $datos[0]->ci;
    }
    public function sexo()
    {
        $datos = Kardex::select('sexo')
            ->where('id_user', '=', $this->id)
            ->get();
        return $datos[0]->sexo;
    }
    public function curso()
    {
        $es = Estudiante::select('id_curso')
            ->where('id_user', '=', $this->id)
            ->get();
        $datos = Curso::select('nombre')
            ->where('id', '=', $es[0]->id_curso)
            ->get();
        return $datos[0]->nombre;
    }
    public function id_est()
    {
        $es = Estudiante::select('id')
            ->where('id_user', '=', $this->id)
            ->get();
        return $es[0]->id;
    }
}
