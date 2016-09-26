<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{


    public function test_login(){

        $this->visit('/')
            ->type('admin' , 'username')
            ->type('123goldkist', 'password')
            ->press('Sign In')
            ->seePageIs('/admin');
    }
}
