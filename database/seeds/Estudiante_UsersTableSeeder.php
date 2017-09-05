<?php

use Illuminate\Database\Seeder;
use \Faker\Factory as Faker;

class Estudiante_UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        \DB::table('users')->insert([
            [
                'email'         => '33331@gmail.com',
                'password'      => \Hash::make('33331'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33332@gmail.com',
                'password'      => \Hash::make('33332'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33333@gmail.com',
                'password'      => \Hash::make('33333'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33334@gmail.com',
                'password'      => \Hash::make('33334'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33335@gmail.com',
                'password'      => \Hash::make('33335'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33336@gmail.com',
                'password'      => \Hash::make('33336'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33337@gmail.com',
                'password'      => \Hash::make('33337'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33338@gmail.com',
                'password'      => \Hash::make('33338'),
                'tipo_usuario'  => 3,
            ],
            [
                'email'         => '33339@gmail.com',
                'password'      => \Hash::make('33339'),
                'tipo_usuario'  => 3,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33331',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 7,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33332',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 8,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33333',
                'sex'           => 1,
                'user_type'     => 3,
                'id_user'       => 9,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33334',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 10,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33335',
                'sex'           => 1,
                'user_type'     => 3,
                'id_user'       => 11,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33336',
                'sex'           => 1,
                'user_type'     => 3,
                'id_user'       => 12,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33337',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 13,
            ],
            [
                'name'          => $faker->firstName,
                'ap_patern'     => $faker->lastName,
                'ap_mother'     => $faker->lastName,
                'ci'            => '33338',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 14,
            ],

            [
                'name'       => $faker->firstName,
                'ap_patern'    => $faker->lastName,
                'ap_mother'    => $faker->lastName,
                'ci'            => '33339',
                'sex'           => 0,
                'user_type'     => 3,
                'id_user'       => 15,
            ]
        ]);
        \DB::table('estudiantes')->insert([
            [
                'id_curso'     => 3,
                'id_user'       => 7,
            ],
            [
                'id_curso'     => 4,
                'id_user'       => 8,
            ],
            [
                'id_curso'     => 5,
                'id_user'       => 9,
            ],
            [
                'id_curso'     => 6,
                'id_user'       => 10,
            ],
            [
                'id_curso'     => 7,
                'id_user'       => 11,
            ],
            [
                'id_curso'     => 8,
                'id_user'       => 12,
            ],
            [
                'id_curso'     => 9,
                'id_user'       => 13,
            ],
            [
                'id_curso'     => 10,
                'id_user'       => 14,
            ],
            [
                'id_curso'     => 7,
                'id_user'       => 15,
            ],
            [
                'id_curso'     => 3,
                'id_user'       => 7,
            ],

        ]);
        \DB::table('asignacions')->insert([
            [
                'id_asignatura' => 1,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 2,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 3,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 4,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 5,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 6,
                'id_estudiante' => 1,
            ],
            [
                'id_asignatura' => 7,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 8,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 9,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 10,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 11,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 12,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 13,
                'id_estudiante' => 2,
            ],
            [
                'id_asignatura' => 14,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 15,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 16,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 17,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 18,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 19,
                'id_estudiante' => 3,
            ],
            [
                'id_asignatura' => 20,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 21,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 22,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 23,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 24,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 25,
                'id_estudiante' => 4,
            ],
            [
                'id_asignatura' => 26,
                'id_estudiante' => 5,
            ],
            [
                'id_asignatura' => 27,
                'id_estudiante' => 5,
            ],
            [
                'id_asignatura' => 28,
                'id_estudiante' => 5,
            ],
            [
                'id_asignatura' => 29,
                'id_estudiante' => 5,
            ],
            [
                'id_asignatura' => 30,
                'id_estudiante' => 5,
            ],
            [
                'id_asignatura' => 31,
                'id_estudiante' => 5,
            ]

        ]);
    }
}
