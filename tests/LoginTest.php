<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{


    public function test_login(){

        $this->visit('/')
            ->type('prs0325' , 'username')
            ->type('123goldkist', 'password')
            ->press('Sign In')
            ->seePageIs('scouter');
    }
}
