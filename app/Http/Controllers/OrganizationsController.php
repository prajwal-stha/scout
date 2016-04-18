<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateOrganizationsRequest;

use App\Organization;
use Session;


class OrganizationsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }


    public function postCreate(CreateOrganizationsRequest $request)
    {
        dd($request->all());
        $org = Organization::create([
            'name'                  => $request->get('name'),
            'type'                  => $request->get('type'),
            'registration_date'     => formatDate($request->get('registration_date')),
            'address_line_1'        => $request->get('address_line_1'),
            'address_line_2'        => $request->get('address_line_2'),
            'district_id'           => $request->get('district'),
            'chairman_f_name'       => $request->get('chairman_f_name'),
            'chairman_l_name'       => $request->get('chairman_l_name'),
            'chairman_mobile_no'    => $request->get('chairman_mobile_no'),
            'tel_no'                => $request->get('tel_no'),
            'email'                 => $request->get('email')
        ]);
        return view('scouter.scarf')->with([
            'org_created'   => 'The organizations is succesfully created',
            'title'         => 'Nepal Scouts - Scarf',
            'org_id'        => $org->id
        ]);
    }

    public function postScarf(Request $request)
    {
        if($request->has('org_id')) {

            Organization::where('id', $request->get('org_id'))
                ->update([
                    'background_colour' => $request->get('background_colour'),
                    'border_colour'     => $request->get('border_colour')
                ]);

            return view('scouter.member')->withTitle('Nepal Scouts - Member');

        }
        else{
            return redirect('scouter');
        }

    }

//    public function postMember(Request $request)
//    {
////        $request->session()->put([
////            'f_name'     => $request->get('f_name'),
////            'm_name'     => $request->get('m_name'),
////            'l_name'     => $request->get('l_name')
////        ]);
//        $data = array(
//            'f_name' => $request->get('f_name'),
//            'm_name' => $request->get('m_name'),
//            'l_name' => $request->get('l_name'));
//        Session::push('member', $data);
//
//        return redirect()->back();
//
//    }

    public function getEditOrganizations()
    {


    }

    public function patchEditOrganizations()
    {


    }




}
