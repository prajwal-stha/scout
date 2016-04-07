<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Scouter;

use App\District;

class ScouterController extends Controller
{


    public function getIndex(){
        $data['district'] = District::all();

        return view('scouter.organization')->with($data);

    }

    public function getScarf(){

        return view('scouter.scarf');
        
    }

    public function getCommitte()
    {
        return view('scouter.member');
        
    }

    public function getScouter()
    {
        return view('scouter.scouter');
        
    }

    public function getTeam()
    {
        return view('scouter.team');
        
    }

    public function getRegistration()
    {
        return view('scouter.registration');
        
    }

}
