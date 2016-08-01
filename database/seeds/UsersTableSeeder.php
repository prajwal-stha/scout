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
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'f_name'         => 'John',
            'l_name'         => 'Doe',
            'email'          => 'admin@gmail.com',
            'verified'       => 1,
            'token'          => bcrypt(str_random(30)),
            'level'          => 1,
            'username'       => 'admin',
            'password'       => bcrypt('123goldkist'),
            'remember_token' => str_random(10)
        ]);


        DB::table('users')->insert([
            'f_name'         => 'Foo',
            'l_name'         => 'Bar',
            'email'          => 'user@gmail.com',
            'verified'       => 1,
            'token'          => bcrypt(str_random(30)),
            'level'          => 0,
            'username'       => 'public',
            'password'       => bcrypt('123goldkist'),
            'remember_token' => str_random(10)
        ]);
    }
}
