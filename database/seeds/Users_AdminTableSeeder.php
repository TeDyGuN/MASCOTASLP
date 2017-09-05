<?php

use Illuminate\Database\Seeder;

class Users_AdminTableSeeder extends Seeder
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
                'email'         => 'admin@admin.com',
                'password'      => \Hash::make('11111'),
                'tipo_usuario'  => 1,
            ]
        ]);
        \DB::table('kardexes')->insert([
            [
                'name'          => 'Admin',
                'ap_patern'     => ' ',
                'ap_mother'     => ' ',
                'ci'            => '1111',
                'sex'           => 1,
                'user_type'     => 1,
                'id_user'       => 1,
            ]
        ]);
    }
}
