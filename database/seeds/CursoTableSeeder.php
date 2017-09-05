<?php

use Illuminate\Database\Seeder;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert(array(
            array('nombre' => '1er Semestre', 'materias' => 6),
            array('nombre' => '2do Semestre', 'materias' => 7),
            array('nombre' => '3er Semestre', 'materias' => 6),
            array('nombre' => '4to Semestre', 'materias' => 7),
            array('nombre' => '5to Semestre', 'materias' => 6),
            array('nombre' => '6to Semestre', 'materias' => 6),
            array('nombre' => '7mo Semestre', 'materias' => 6),
            array('nombre' => '8vo Semestre', 'materias' => 6),
            array('nombre' => '9no Semestre', 'materias' => 4),
            array('nombre' => '10mo Semestre', 'materias' => 3)
        ));
    }
}
