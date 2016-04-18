<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Scouter;

use App\District;

use App\User;

class ScouterController extends Controller
{

    public function __construct(){

        $this->middleware('auth', ['except' => 'logout']);

    }


    public function getIndex(){
        $data['district'] = District::all();
        $data['title']    = 'Nepal Scout - Organizations';

        return view('scouter.organization')->with($data);

    }

    public function getScarf(){
        $data['title']   = 'Nepal Scout - Scarf';

        return view('scouter.scarf')->with($data);
        
    }

    public function getCommitte()
    {
        $data['title']  = 'Nepal Scout - Member';

        return view('scouter.member')->with($data);
        
    }

    public function getScouter()
    {
        $data['title'] = 'Nepal Scout - Scouter';
        if(session()->has('f_name')) {
            $data['f_name'] = session()->get('f_name');
            $data['m_name'] = session()->get('m_name');
            $data['l_name'] = session()->get('l_name');

            return view('scouter.scouter')->with($data);
        }
        else{
            echo "No session";
        }
        
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
