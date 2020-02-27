<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
        	'name' => 'Administrador',
            'rut' => '12121212121',
            'telefono' => '1212123434343',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456')
        ]);
    }
}