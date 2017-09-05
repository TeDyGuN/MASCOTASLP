<?php

use Illuminate\Database\Seeder;

class Docente_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'email'         => '22221@gmail.com',
                'password'      => \Hash::make('22221'),
                'tipo_usuario'  => 2,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Alejandro',
                'ap_patern'     => 'Zambrana',
                'ap_mother'     => 'Camberos',
                'ci'            => '22221',
                'sex'           => 1,
                'user_type'     => 2,
                'id_user'       => 2,
            ]
        ]);
        \DB::table('users')->insert([
            [
                'email'         => '22222@gmail.com',
                'password'      => \Hash::make('22222'),
                'tipo_usuario'  => 2,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Cynthia',
                'ap_patern'     => 'Rodriguez',
                'ap_mother'     => 'Rodriguez',
                'ci'            => '22222',
                'sex'           => 0,
                'user_type'     => 2,
                'id_user'       => 3,
            ]
        ]);
        \DB::table('users')->insert([
            [
                'email'         => '22223@gmail.com',
                'password'      => \Hash::make('22223'),
                'tipo_usuario'  => 2,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Luis',
                'ap_patern'     => 'Ruiz',
                'ap_mother'     => 'Lara',
                'ci'            => '22223',
                'sex'           => 1,
                'user_type'     => 2,
                'id_user'       => 4,
            ]
        ]);
        \DB::table('users')->insert([
            [
                'email'         => '22224@gmail.com',
                'password'      => \Hash::make('22224'),
                'tipo_usuario'  => 2,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Osamu',
                'ap_patern'     => 'Yokosaki',
                'ap_mother'     => 'Nagatani',
                'ci'            => '22224',
                'sex'           => 1,
                'user_type'     => 2,
                'id_user'       => 5,
            ]
        ]);
        \DB::table('users')->insert([
            [
                'email'         => '22225@gmail.com',
                'password'      => \Hash::make('22225'),
                'tipo_usuario'  => 2,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Claudia',
                'ap_patern'     => 'Yaniquez',
                'ap_mother'     => 'Yaniquez',
                'ci'            => '22225',
                'sex'           => 0,
                'user_type'     => 2,
                'id_user'       => 6,
            ]
        ]);
    }
}
