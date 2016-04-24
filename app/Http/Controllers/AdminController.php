<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\User;

use App\Organization;

use App\District;

use App\Member;

use App\Scouter;

use App\Team;

use App\TeamMember;

use App\Rate;

use DB;

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
        $data['title']     = 'Nepal Scout - Dashboard';
        $data['org'] = Organization::whereNull('registration_no')->count();
        return view( 'admin.dashboard')->with( $data);
    }

    public function getForm(){
        $data['organizations'] = Organization::whereNull('registration_no')->get();
        $data['title'] = 'Nepal Scout - New Form Requests';
        return view( 'admin.formrequest')->with($data);
    }

    public function getViewOrganization($id = NULL)
    {
        $data['organization'] = Organization::findOrFail($id);
        $data['district'] = District::all();
        $data['title'] = 'Nepal Scout';
        return view('admin.organization')->with( $data );

    }


    public function patchOrganization(Request $request, $id)
    {
        $rules = array(
            'registration_date'     => 'required|date_format:"d/m/Y"',
            'type'                  => 'required|string',
            'name'                  => 'required|unique:organizations,name,'.$request->get('id'),
            'district'              => 'required|exists:districts,id',
            'chairman_f_name'       => 'required|string',
            'chairman_l_name'       => 'required|string',
            'chairman_mobile_no'    => 'required|string',
            'tel_no'                => 'required|string',
            'address_line_1'        => 'required|string',
            'address_line_2'        => 'string',
            'email'                 => 'required|email|unique:organizations,email,'.$request->get('id'),
            'background_colour'     => 'required',
            'border_colour'         => 'required',
        );

        $org = Organization::findOrFail($id);

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $org->name               = $request->get('name');
            $org->type               = $request->get('type');
            $org->registration_date  = $request->has('registration_date') ? formatDate($request->get('registration_date')) : null;
            $org->address_line_1     = $request->get('address_line_1');
            $org->address_line_2     = $request->has('address_line_2') ? $request->get('address_line_2') : '';
            $org->district_id        = $request->get('district');
            $org->chairman_f_name    = $request->get('chairman_f_name');
            $org->chairman_l_name    = $request->get('chairman_f_name');
            $org->chairman_mobile_no = $request->get('chairman_mobile_no');
            $org->tel_no             = $request->get('tel_no');
            $org->email              = $request->get('email');
            $org->background_colour  = $request->get('background_colour');
            $org->border_colour      = $request->get('border_colour');
            $org->save();
        }

        return redirect()->back()
            ->with(['org_update' => 'Organization successfully updated']);
        
    }


    public function getCommittee($id)
    {
        $data['title'] = 'Nepal Scout';

        $data['organization'] = Organization::findOrFail($id);

        $data['member'] = Member::where('organization_id', $id)->get();
        return view('admin.member')->with($data);

    }

    public function patchCommittee(Request $request, $id)
    {
        
    }

    public function getDeleteCommittee($id)
    {

        
    }

    public function getLeadScouter($id)
    {
        $data['title'] = 'Nepal Scout';

        $data['organization'] = Organization::findOrFail($id);
        $data['member'] = Member::where('organization_id', $id)->get();
        $data['leadScouter'] = Scouter::where('organization_id', $id)
            ->where('is_lead', 1)
            ->first();

        return view('admin/lead-scouter')->with( $data );

        
    }


    public function getScouter($id)
    {

        $data['title'] = 'Nepal Scout';

        $data['organization'] = Organization::findOrFail($id);
        $data['member'] = Member::where('organization_id', $id)->get();
        $data['scouter'] = Scouter::where('organization_id', $id)
            ->where('is_lead', 0)
            ->first();

        return view('admin/scouter')->with( $data );

    }

    public function getTeams($id, $team_id = NULL)
    {
        $data['title'] = 'Nepal Scout';
        $data['organization'] = Organization::findOrFail($id);
        $data['team'] = Team::where('organization_id', $id)->get();

        if(is_null($team_id)) {
            $data['teamId'] = $data['team']->first()->id;
        }else{

            $data['teamId'] = $team_id;
        }

        $data['team_member'] = TeamMember::where('team_id', $data['teamId'])->get();

        return view('admin.team')->with($data);

    }

    public function getTeamMembers($id, $team_id)
    {
        $data['title'] = 'Nepal Scout';
        $data['organization'] = Organization::findOrFail($id);
        $data['team'] = Team::where('organization_id', $id)->get();


    }

    public function patchTeams(Request $request, $id)
    {


    }


    public function getDeleteTeams($id)
    {


    }

    public function getMember($id){

    }

    public function patchMember(Request $request, $id)
    {

    }

    public function getDeleteMember($id)
    {
        
    }

    public function getRegistration($id)
    {

        $data['title']        = 'Nepal Scout - Registration Cost Detail';
        $data['rates']        = Rate::first();
        $data['organization'] = Organization::findOrFail($id);

        $data['scouter']      = intval(Scouter::where('organization_id', $id)->count());
        $data['scout']        = intval(DB::table('teams')
            ->join('team_members', function ($join) {
                $join->on('teams.id', '=', 'team_members.team_id')
                    ->where('teams.organization_id', '=', '$id');
            })
            ->count());
        $data['member'] = intval(Member::where('organization_id', $id)->count());
        $data['total']  = $data['scouter'] + $data['scout'] + $data['member'];

        return view('admin.registration')->with($data);
        
    }
}