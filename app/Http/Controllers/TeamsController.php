<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Teams;

class TeamsController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }


}
