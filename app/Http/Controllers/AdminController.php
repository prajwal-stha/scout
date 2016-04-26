<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Scout\Service\CloneTable;

use App\Http\Requests;

use App\Http\Requests\CreateOrganizationAdminRequest;
use App\Http\Requests\UpdateScouterRequest;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\CreateRegisterRequest;

use App\Http\Controllers\Controller;

use App\User;

use App\Organization;

use App\District;

use App\Member;

use App\Scouter;

use App\Team;

use App\TeamMember;

use App\Rate;
use App\CoreOrganization;
use App\CoreMember;
use App\CoreTeam;
use App\CoreTeamMember;
use App\CoreScouter;


use DB;

use Validator;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * @var CloneTable
     */
    protected $clone;

    /**
     * @var
     */
    protected $organization;

    /**
     * @var
     */
//    protected $team;

    /**
     * @var
     */
    //protected $member;

    /**
     * @var
     */
    //protected $team_member;

    /**
     * @var
     */
    //protected $scouter;

    /**
     * AdminController constructor.
     * @param CloneTable $clone
     */
    public function __construct(CloneTable $clone){
        $this->middleware('auth');
        $this->clone = $clone;
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

    /**
     * @return $this
     */
    public function getForm(){
        $data['organizations'] = Organization::whereNull('registration_no')
                ->where('is_declined', false)->get();
        $data['title'] = 'Nepal Scout - New Form Requests';
        return view( 'admin.formrequest')->with($data);
    }

    /**
     * @param null $id
     * @return $this
     */
    public function getViewOrganization($id = NULL)
    {
        $data['organization'] = Organization::findOrFail($id);
        $data['district'] = District::all();
        $data['title'] = 'Nepal Scout';
        return view('admin.organization')->with( $data );

    }


    /**
     * @param CreateOrganizationAdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchOrganization(CreateOrganizationAdminRequest $request, $id)
    {

        $org = Organization::findOrFail($id);


        if($org){
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


    /**
     * @param $id
     * @return $this
     */
    public function getCommittee($id)
    {
        $data['title'] = 'Nepal Scout';

        $data['organization'] = Organization::findOrFail($id);

        $data['member'] = Member::where('organization_id', $id)->get();
        return view('admin.member')->with($data);

    }

    /**
     * @param CreateMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCommittee(CreateMemberRequest $request)
    {
        Member::create([
            'f_name'            => $request->get('f_name'),
            'm_name'            => $request->get('m_name'),
            'l_name'            => $request->get('l_name'),
            'organization_id'   => $request->get('organization_id')
        ]);

        return redirect()->back()->with(['member_created' => 'One of the member has been added to your organization']);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommitteeMember($id)
    {
        $member = Member::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'member'    => $member
        );
        return response()->json($response);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patchCommittee(Request $request)
    {
        $rules = array(
            'f_name'            => 'required',
            'l_name'            => 'required',
            'organization_id'   => 'required|exists:organizations,id'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg'    => $validator->getMessageBag()->toArray()
            );
        } else {
            $id = $request->get('id');

            if($id){
                $member = Member::findOrFail($id);
                $input = $request->all();

                $member->fill($input)->save();

                $response = array(
                    'status'   => 'success',
                    'msg'      => 'Member successfully updated.',
                    'member'   => $member
                );
            }

        }
        return response()->json($response);
        
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDeleteCommittee($id)
    {
        $member = Member::findOrFail($id);
        if($member){
            Member::destroy($member->id);
        }
        return redirect()->back()
            ->with('committee_member_deleted', 'One of the committe member has been removed from the organization.');
        
    }

    /**
     * @param $id
     * @return $this
     */
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

    /**
     * @param UpdateScouterRequest $request
     * @param $scouter_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchLead(UpdateScouterRequest $request, $scouter_id)
    {
        if($scouter_id) {

            $scouter = Scouter::findOrFail($scouter_id);
            if ($scouter) {
                $scouter->name = $request->get('name');
                $scouter->email = $request->get('email');
                $scouter->permission = $request->get('permission');
                $scouter->permission_date = $request->has('permission_date') ? formatDate($request->get('permission_date')) : null;
                $scouter->btc_no = $request->get('btc_no');
                $scouter->btc_date = $request->has('btc_date') ? formatDate($request->get('btc_date')) : null;
                $scouter->advance_no = $request->get('advance_no');
                $scouter->advance_date = $request->has('advance_date') ? formatDate($request->get('advance_date')) : null;
                $scouter->alt_no = $request->get('alt_no');
                $scouter->alt_date = $request->has('alt_date') ? formatDate($request->get('alt_date')) : null;
                $scouter->lt_no = $request->get('lt_no');
                $scouter->lt_date = $request->has('lt_date') ? formatDate($request->get('lt_date')) : null;
                $scouter->save();
            }

            return redirect()->back()
                ->with(['lead_scouter_updated' => 'Lead Scouter successfully updated']);
        }

    }

    /**
     * @param UpdateScouterRequest $request
     * @param $scouter_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchScouter(UpdateScouterRequest $request, $scouter_id)
    {
        if($scouter_id){
            $scouter = Scouter::findOrFail($scouter_id);
            if($scouter){
                $scouter->name              = $request->get('name');
                $scouter->email             = $request->get('email');
                $scouter->permission        = $request->get('permission');
                $scouter->permission_date   = $request->has('permission_date') ? formatDate($request->get('permission_date')) : null;
                $scouter->btc_no            = $request->get('btc_no');
                $scouter->btc_date          = $request->has('btc_date') ? formatDate($request->get('btc_date')) : null;
                $scouter->advance_no        = $request->get('advance_no');
                $scouter->advance_date      = $request->has('advance_date') ? formatDate($request->get('advance_date')) : null;
                $scouter->alt_no            = $request->get('alt_no');
                $scouter->alt_date          = $request->has('alt_date') ? formatDate($request->get('alt_date')) : null;
                $scouter->lt_no             = $request->get('lt_no');
                $scouter->lt_date           = $request->has('lt_date') ? formatDate($request->get('lt_date')) : null;
                $scouter->save();
            }

            return redirect()->back()
                ->with(['scouter_updated' => 'Assistant Lead Scouter successfully updated']);
        }
    }


    /**
     * @param $id
     * @return $this
     */
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

    /**
     * @param $id
     * @param null $team_id
     * @return $this
     */
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


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUpdateTeam($id)
    {
        $team = Team::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'team'    => $team
        );
        return response()->json($response);
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patchTeams(Request $request)
    {
        $rules = array(
            'name'              => 'required|unique:teams,name,'.$request->get('id'),
            'organization_id'   => 'required|exists:organizations,id'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg'    => $validator->getMessageBag()->toArray()
            );

        } else {
            $id = $request->get('id');
            if ( $id ) {
                $team  = Team::findOrFail($id);
                $input = $request->all();

                $team->fill($input)->save();

                $response = array(
                    'status'   => 'success',
                    'msg'      => 'Team successfully updated.',
                    'team'     => $team
                );
            }
        }
        return response()->json($response);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDeleteTeams($id)
    {
        $team = Team::findOrFail($id);
        if($team){
            Team::destroy($team->id);
        }
        return redirect()->back()->with('team_deleted', 'One of the team has been removed');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMember($id)
    {
        $teamMember = TeamMember::findOrFail($id);
        $response = array(
            'status'        => 'success',
            'teamMember'    => $teamMember
        );
        return response()->json($response);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patchMember(Request $request)
    {
        $rules = array(
            'f_name'        => 'required',
            'l_name'        => 'required',
            'dob'           => 'required|date_format:"d/m/Y"',
            'entry_date'    => 'required|date_format:"d/m/Y"',
            'position'      => 'required',
            'passed_date'   => 'required|date_format:"d/m/Y"|after:entry_date',
            'note'          => 'max:500',
            'team_id'       => 'required|exists:teams,id'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg'    => $validator->getMessageBag()->toArray()
            );

        } else {
            $id = $request->get('id');
            if($id){
                $teamMember = TeamMember::findOrFail($id);
                if($teamMember){
                    $teamMember->f_name            = $request->get('f_name');
                    $teamMember->m_name            = $request->get('m_name');
                    $teamMember->l_name            = $request->get('l_name');
                    $teamMember->dob               = $request->has('dob') ? formatDate($request->get('dob')) : null;
                    $teamMember->entry_date        = $request->has('entry_date') ? formatDate($request->get('entry_date')) : null;
                    $teamMember->position          = $request->get('position');
                    $teamMember->passed_date       = $request->has('passed_date') ? formatDate($request->get('passed_date')) : null;
                    $teamMember->note              = $request->get('note');
                    $teamMember->team_id           = $request->get('team_id');
                    $teamMember->save();
                }

                $response = array(
                    'status'         => 'success',
                    'msg'            => 'Team Member successfully updated successfully updated.',
                    'teamMember'     => $teamMember
                );
            }
        }
        return response()->json($response);

    }

    /**
     * @param $id
     */
    public function getDeleteMember($id)
    {
        $member = TeamMember::findOrFail($id);
        if($member){
            TeamMember::destroy($member->id);
        }
//        return redirect()->back()->with('member_deleted', 'One of the member has been removed');
        
    }

    /**
     * @param $id
     * @return $this
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patchRegister(Request $request)
    {
        $rules = array(
            'registration_no'   => 'required|unique:organizations,registration_no',
            'organization_id'   => 'required|exists:organizations,id'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg'    => $validator->getMessageBag()->toArray()
            );

        } else {
            $id = $request->get('organization_id');

            $org = Organization::findOrFail($id);
            if($org){

                $org->registration_no = $request->get('registration_no');
                $org->save();
            }

            $response = array(
                'status'   => 'success',
                'msg'      => 'Organization successfully updated.'
            );
            $this->cloneModel($org->id);

        }
        return response()->json($response);
    }

    /**
     * Declines Form Requests
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchDecline(Request $request)
    {
        $rules = array(
            'organization_id'   => 'required|exists:organizations,id'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->passes()) {
            $id = $request->get('organization_id');

            $org = Organization::findOrFail($id);
            if($org){

                $org->is_declined = true;
                $org->save();
            }

        }
        return redirect()->back()->with('organization_deleted', 'The organizaton has been declined.');
    }


    /**
     * @param $id
     */
    public function cloneModel($id){


        // related organization committe member
        // related team
        // related team member
        // related scouter

        $this->organization = Organization::find($id);

//        $this->member = Member::where('organization_id', $id)->get();
//
//        $this->team = Team::where('organization_id', $id)->get();
//
//        $this->scouter = Scouter::where('organization_id', $id)->get();

        // Clone organization
        $this->cloneOrganization();

       // Clone Organization Commiitte Member
        $this->cloneMember();

        // Clone Team
        $this->cloneTeam();

        // Clone Scouter
        //$this->cloneScouter();

        //  Clone Team Member
        $this->cloneTeammember();

    }

    /**
     *
     */
    public function cloneOrganization(){

        // Variable : manipulation
        $attributes = $this->organization->get_attributes();

        // new or overwrite data
        $this->clone->setOverwrite(array(
            'original_id' => $this->organization->id,
        ));

        $this->clone->cloneObject($this->organization, $this->findAbstractModel('CoreOrganization'), $attributes);

        print_r($this->clone->errors());

    }


    /**
     *
     */
    public function cloneMember()
    {

        $member = new Member;
        $cloningData = $this->organization->members->all();

        $overwrites = array();

        foreach($cloningData as $data){
            $overwrites[] = $data->id;
        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreMember'), $member->get_attributes(), $overwrites);

        print_r($this->clone->errors());
        
    }

    /**
     *
     */
    public function cloneTeam()
    {

        $team = new Team;
        $cloningData = $this->organization->teams->all();
        $overwrites = array();

        foreach($cloningData as $data){
            $overwrites[] = $data->id;
        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreTeam'), $team->get_attributes(), $overwrites);

        print_r($this->clone->errors());
        
    }

    /**
     *
     */
    public function cloneScouter()
    {
        $scouter = new Scouter;
        $cloningData = $this->organization->scouters->all();
        $overwrites = array();

        foreach($cloningData as $data){
            $overwrites[] = $data->id;
        }

        $this->clone->cloneMultipleObjects($cloningData, $this->findAbstractModel('CoreScouter'), $scouter->get_attributes(), $overwrites);

        print_r($this->clone->errors());

    }

    /**
     *
     */
    public function cloneTeammember()
    {





        $attributes = $this->team_member->get_attributes();

        //$this->team = Team::where('organization_id', $id)->get();


        // new or overwrite data
        $this->clone->setOverwrite(array(
            'original_id' => $this->team_member->id
        ));

        $this->clone->cloneObject($this->team_member, $this->findAbstractModel('CoreTeamMember'), $attributes);

        print_r($this->clone->errors());
        
    }


    /**
     * @param $name
     * @return CoreMember|CoreOrganization|CoreScouter|CoreTeam|CoreTeamMember
     */
    private function findAbstractModel($name){

        switch ($name){
            case 'CoreOrganization':
                return new CoreOrganization;
            break;

            case 'CoreMember':
                return new CoreMember;
            break;

            case 'CoreTeam':
                return new CoreTeam;
            break;

            case 'CoreTeamMember':
                return new CoreTeamMember;
            break;

            case 'CoreScouter':
                return new CoreScouter;
            break;

        }

    }
}