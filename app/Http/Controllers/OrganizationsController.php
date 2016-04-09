<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateOrganizationsRequest;

use App\Organization;


class OrganizationsController extends Controller
{


    public function postCreate(CreateOrganizationsRequest $request)
    {
        dd($request->all());
        
    }

    public function getEditOrganizations()
    {

    }

    public function patchEditOrganizations()
    {

    }

}
