<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Scouter;

use App\District;

use App\User;

use App\Member;
use App\Organization;

class ScouterController extends Controller
{

    public function __construct(){

        $this->middleware('auth', ['except' => 'logout']);

    }


    public function getIndex(){
        $data['district'] = District::all();
        $data['title']    = 'Nepal Scout - Organizations';
        if(session()->has('org_id')){
            $data['org_id'] = session()->get('org_id');
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));
        }

        return view('scouter.organization')->with($data);

    }

    public function getScarf(){
        $data['title']   = 'Nepal Scout - Scarf';
        if(session()->has('org_id')){

            $data['org_id'] = session()->get('org_id');
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));
        }

        return view('scouter.scarf')->with($data);
        
    }

    public function getCommitte()
    {
        $data['title']  = 'Nepal Scout - Member';

        if(session()->has('org_id')){

            $data['org_id']        = session()->get('org_id');
            if(Member::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();
            }

        }
        return view('scouter.member')->with($data);
    }

    public function getScouter()
    {
        $data['title'] = 'Nepal Scout - Scouter';
        if(session()->has('org_id')) {
            $data['org_id']        = session()->get('org_id');
            if(Member::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();
            }
        }
        return view('scouter.scouter')->with($data);
        
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
