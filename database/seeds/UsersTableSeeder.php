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
        DB::table('users')->insert([
            'f_name'         => 'Prajwal',
            'l_name'         => 'Shrestha',
            'email'          => 'prajwal_stha@yahoo.com',
            'level'          => 1,
            'username'       => 'prajwal_stha',
            'password'       => bcrypt('123goldkist'),
            'remember_token' => str_random(10)
        ]);
    }
}
