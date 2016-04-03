<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Scouter;

class ScouterController extends Controller
{

    public function __construct()
    {

    }

    public function getIndex(){
        return view('auth.register');
    }
}
