<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login(){

        $this->visit('/')
            ->type('admin' , 'username')
            ->type('123goldkist', 'password')
            ->press('Sign In');
    }
}
