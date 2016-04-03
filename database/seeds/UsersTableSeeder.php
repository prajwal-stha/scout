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
            'name' => 'Prajwal Shrestha',
            'email' => 'prajwal_stha@yahoo.com',
            'password' => bcrypt('123goldkist'),
            'remember_token' => str_random(10)
        ]);
    }
}
