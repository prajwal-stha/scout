<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateOrganizationsRequest;

use App\Organization;
use Session;


class OrganizationsController extends Controller
{


    public function postCreate(CreateOrganizationsRequest $request)
    {
        $request->session()->put([
            'name'                  => $request->get('name'),
            'type'                  => $request->get('type'),
            'registration_date'     => $request->get('registration_date'),
            'address_line_1'        => $request->get('address_line_1'),
            'address_line_2'        => $request->get('address_line_2'),
            'district'              => $request->get('district'),
            'chairman_f_name'       => $request->get('chairman_f_name'),
            'chairman_l_name'       => $request->get('chairman_l_name'),
            'chairman_mobile_no'    => $request->get('chairman_mobile_no'),
            'tel_no'                => $request->get('tel_no'),
            'email'                 => $request->get('email')
        ]);
        return view('scouter.scarf')->withTitle('Nepal Scouts - Scarf');
    }

    public function postScarf(Request $request)
    {
        $request->session()->put([
            'background_colour'     => $request->get('background_colour'),
            'border_colour'         => $request->get('border_colour')
        ]);
        return view('scouter.member')->withTitle('Nepal Scouts - Member');

    }

    public function postMember(Request $request)
    {
        $request->session()->put([
            'f_name'     => $request->get('f_name'),
            'm_name'     => $request->get('m_name'),
            'l_name'     => $request->get('l_name')
        ]);
        return redirect('scouter/scouter');

    }

    public function getEditOrganizations()
    {

    }

    public function patchEditOrganizations()
    {

    }

}
