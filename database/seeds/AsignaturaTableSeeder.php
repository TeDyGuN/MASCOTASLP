<?php

use Illuminate\Database\Seeder;

class AsignaturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Diseño y Programacion de Microprocesadores I',
            'id_curso' => '3',
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Ecuaciones Diferenciales',
            'id_curso' => '3'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Electronica Aplicada',
            'id_curso' => '3'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Estadistica y Probabilidades II',
            'id_curso' => '3'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Programacion Orientada a Objetos',
            'id_curso' => '3'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Sistemas Administrativos y Contables',
            'id_curso' => '3'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Diseño y Programacion de Microprocesadores II',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Estructura de Datos',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Investigacion Operativa I',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Metodologia de la Investigacion',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Metodos Numericos',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Sistemas Economicos',
            'id_curso' => '4'
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Teoria General de Sistemas',
            'id_curso' => '4'
        ));
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Analisis y Diseño de Sistemas I', 'id_curso' => 5),
            array('nombre' => 'Gestion de Base de Datos I', 'id_curso' => 5),
            array('nombre' => 'Ínvestigacion Operativa II', 'id_curso' => 5),
            array('nombre' => 'Planeacion y Procesos de Sistemas', 'id_curso' => 5),
            array('nombre' => 'Sistemas de Control y Automatizacion', 'id_curso' => 5)
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Tecnologia de Comunicaciones y Redes I',
            'id_curso' => 5,
            'id_docente' => '4'
        ));
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Administracion de Sistemas Operativos y Servidores', 'id_curso' => 6),
            array('nombre' => 'Gestion de Base de Datos II', 'id_curso' => 6),
            array('nombre' => 'Ínvestigacion Operativa III', 'id_curso' => 6),
            array('nombre' => 'Analisis y Diseño de Sistemas II', 'id_curso' => 6),
            array('nombre' => 'Modelacion de Sistemas', 'id_curso' => 6)
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Tecnologia de Comunicaciones y Redes II',
            'id_curso' => 6,
            'id_docente' => '4'
        ));
        //Antiguo Pensum
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Ingenieria de Software I', 'id_curso' => 7),
            array('nombre' => 'Inteligencia Artificial I', 'id_curso' => 7),
            array('nombre' => 'Programacion Avanzada', 'id_curso' => 7),
            array('nombre' => 'Robotica', 'id_curso' => 7),
            array('nombre' => 'Simulacion de Sistemas', 'id_curso' => 7)
        ));
        \DB::table('asignaturas')->insert(array(
            'nombre'=> 'Tecnologia de Comunicaciones y Redes III',
            'id_curso' => 7,
            'id_docente' => '4'
        ));
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Seguridad de Sistemas', 'id_curso' => 8),
            array('nombre' => 'Inteligencia Artificial II', 'id_curso' => 8),
            array('nombre' => 'Sistemas Distribuidos', 'id_curso' => 8),
            array('nombre' => 'Ingenieria de Software II', 'id_curso' => 8),
            array('nombre' => 'Sistemas de Mercadeo', 'id_curso' => 8),
            array('nombre' => 'Preparacion y Evaluacion de Proyectos', 'id_curso' => 8)
        ));
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Seminario de Actualizacion Sistemas de Informacion', 'id_curso' => 9),
            array('nombre' => 'Auditoria de Sistemas', 'id_curso' => 9),
            array('nombre' => 'Trabajo de Grado I', 'id_curso' => 9),
            array('nombre' => 'Ingenieria Legal', 'id_curso' => 9)
        ));
        DB::table('asignaturas')->insert(array(
            array('nombre' => 'Seminario de Actualizacion Tecnologia de Comunicacion y Redes', 'id_curso' => 10),
            array('nombre' => 'Gestion de Proyectos Informaticos', 'id_curso' => 10),
            array('nombre' => 'Trabajo de Grado II', 'id_curso' => 10),
        ));
    }
}
