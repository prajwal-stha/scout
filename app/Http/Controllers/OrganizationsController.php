<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateOrganizationsRequest;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateScarfRequest;

use App\Organization;
use App\Member;
use Session;
use Auth;

class OrganizationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function postCreate(CreateOrganizationsRequest $request)
    {

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
            'email'                 => $request->get('email'),
            'user_id'               => Auth::user()->id,

        ]);
        session()->put('org_id', $org->id);
        return view('scouter.scarf')->with([
            'org_created'   => 'The organizations is succesfully created',
            'title'         => 'Nepal Scouts - Scarf'
        ]);
    }

    public function patchEdit($id, Request $request)
    {
        $org = Organization::findOrFail($id);

        $input = $request->all();

        $org->fill($input)->save();

        return redirect()->back()
            ->with(['org_update' => 'Organization successfully updated'])
            ->withInput();

    }

    public function postScarf(CreateScarfRequest $request)
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

    public function patchEditScarf($id, Request $request)
    {
        $org = Organization::findOrFail($id);

        $input = $request->all();

        $org->fill($input)->save();
        return redirect()->back()
            ->with(['scarf_update' => 'Scarf successfully updated'])
            ->withInput();

    }

    public function postMember(CreateMemberRequest $request)
    {
        if($request->has('org_id')) {
            Member::create([
                'f_name' => $request->get('f_name'),
                'm_name' => $request->get('m_name'),
                'l_name' => $request->get('l_name'),
                'organization_id'   => $request->get('org_id')
            ]);

           return redirect()->back()->with(['member_created' => 'One of the member has been added to your organization']);

        } else {
            return redirect('scouter');
        }
    }

    public function postRemove(Request $request)
    {
        dd($request);
        if ( is_array($request->get('action_to')) ){
            Member::destroy($request->get('action_to'));
            return redirect()->back();
        } else {

            return redirect()->back();
        }
    }

    public function getDeleteMember($id)
    {
        $member = Member::findOrFail($id);
        if($member){
            Member::destroy($member->id);
        }
        return redirect()->back();
        
    }


    public function patchUpdateMember($request)
    {
        $id = $request->get('id');

        if($id){
            $member = Member::findOrFail($id);
            $input = $request->all();

            $member->fill($input)->save();

            return redirect()->back()
                ->with(['member_updated' => 'Member successfully updated']);
        }
        
    }

    public function getUpdateMember($id)
    {
        $member = Member::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'member'    => $member
        );
        return response()->json($response);

    }

    public function patchEditOrganizations()
    {


    }

}
