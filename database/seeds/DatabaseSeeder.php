<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(Users_AdminTableSeeder::class);
        $this->call(Docente_UserTableSeeder::class);
        $this->call(CursoTableSeeder::class);
        $this->call(AsignaturaTableSeeder::class);
        $this->call(Estudiante_UsersTableSeeder::class);
        Model::reguard();
    }
}
