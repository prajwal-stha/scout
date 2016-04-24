<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\User;

use App\Organization;


class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view( 'admin.dashboard', array( 'title' => 'Nepal Scout - Dashboard' ));
    }

    public function getForm(){
        $data['organizations'] = Organization::whereNull('registration_no')->get();
        $data['title'] = 'Nepal Scout - New Form Requests';
        return view( 'admin.formrequest')->with($data);
    }

    public function getViewForm($id = NULL)
    {
        $data['organization'] = Organization::findOrFail($id);
        dd($data['organization']);

    }
}