<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateScouterRequest;
use App\Http\Requests\UpdateScouterRequest;
use App\Http\Requests\UpdateScouterProfileRequest;

use Auth;

use App\Scouter;

use App\District;

use App\User;

use App\Member;
use App\Organization;

use App\Team;

use App\Rate;

use App\Term;

use DB;

use PDF;

/**
 * Class ScouterController
 * @package App\Http\Controllers
 */
class ScouterController extends Controller
{

    protected $user;
    /**
     * ScouterController constructor.
     * @param $auth
     */
    public function __construct(Guard $auth){

        $this->middleware( ['auth', 'xss'] );
        $this->user = $auth->user();

    }


    /**
     * @return $this
     */
    public function getIndex(){
        $data['district'] = District::all();
        $data['title']    = 'Nepal Scout - Organizations';
        $org = Organization::where('user_id', $this->user->id)->first();

        if($org){

            $data['org_id']       = $org->id;

            $data['organization'] = $org;
        }
        return view('scouter.organization')->with($data);

    }

    /**
     * @return $this
     */
    public function getScarf(){
        $data['title']   = 'Nepal Scout - Scarf';
        $org = Organization::where('user_id', $this->user->id)->first();
        if($org){
            $data['org_id']       = $org->id;
            $data['organization'] = $org;
            return view('scouter.scarf')->with($data);
        }else{
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }
        
    }

    /**
     * @return $this
     */
    public function getCommitte()
    {
        $data['title']  = 'Nepal Scout - Member';
        $org = Organization::where('user_id', $this->user->id)->first();

        if($org){
            $data['org_id']       = $org->id;
            if(Member::where( 'organization_id', $org->id)->count() == 0) {

                Member::create([
                    'f_name' => $org->chairman_f_name,
                    'm_name' => $org->chairman_m_name,
                    'l_name' => $org->chairman_l_name,
                    'organization_id' => $org->id
                ]);
            }

            if(Member::where( 'organization_id', $org->id)->count() > 0){
                $data['member'] = Member::where('organization_id', $org->id)->get();
            }
            return view('scouter.member')->with($data);

        }else{
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }

    }



    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getScouter()
    {
        $data['title'] = 'Nepal Scout - Scouter';
        $org = Organization::where('user_id', $this->user->id)->first();
        if($org){
            $data['org_id']       = $org->id;
            if(Member::where( 'organization_id', $org->id)->distinct()->count() >= 3) {

                $data['member'] = Member::where('organization_id', $org->id)->get();

            } else {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if(Scouter::where( 'organization_id', $org->id)->count() > 0 ) {
                $data['scouter']  = Scouter::where('organization_id', $org->id)
                                    ->where('is_lead', 0)
                                    ->first();
            }
            return view('scouter.scouter')->with($data);

        }
        else{
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }

        
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getLeadScouter()
    {
        $data['title'] = 'Nepal Scout - Scouter';

        $org = Organization::where('user_id', $this->user->id)->first();
        if($org){
            $data['org_id']       = $org->id;
            if (Member::where('organization_id', $org->id)->distinct()->count() >= 3) {
                $data['member'] = Member::where('organization_id', $org->id)->get();
            }else{

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if (Scouter::where('organization_id', $org->id)
                    ->where('is_lead', true)->count() > 0) {
                $data['leadScouter'] = Scouter::where('organization_id', $org->id)
                    ->where('is_lead', 1)
                    ->first();
            }
            return view('scouter.lead-scouter')->with($data);
        }
        else {
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }

    }

    /**
     * @param null $teamId
     * @return $this
     */
    public function getTeam($teamId = null)
    {
        $data['title'] = 'Nepal Scout - Scouter';
        $org = Organization::where('user_id', $this->user->id)->first();
        if($org){
            $data['org_id'] = $org->id;
            if (is_null($teamId)) {

                if (Team::where('organization_id', $org->id)->count() > 0) {
                    $data['team'] = Team::where('organization_id', $org->id)->get();
                    $data['teamId'] = $data['team']->first()->id;
                    if ($data['teamId']) {
                        $data['team_member'] = TeamMember::where('team_id', $data['teamId'])->get();
                        $data['team_name']   = Team::findOrFail($data['teamId'])->name;
                        $data['team_type']   = Team::findOrFail($data['teamId'])->type;
                    }
                }

            } else {

                if (Team::where('organization_id', $org->id)->count() > 0) {
                    $data['team']        = Team::where('organization_id', $org->id)->get();
                    $data['team_member'] = TeamMember::where('team_id', $teamId)->get();
                    $data['teamId']      = $teamId;
                    $data['team_name']   = Team::findOrFail($teamId)->name;
                    $data['team_type']   = Team::findOrFail($teamId)->type;
                }

            }
            return view('scouter.team')->with($data);
        } else {
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }

    }


    /**
     * @return $this
     */
    public function getRegistration()
    {
        $data['title']      = 'Registration Cost Detail';
        $data['rates']      = Rate::first();
        $org = Organization::where('user_id', $this->user->id)->first();

        if($org) {
            if (Member::where('organization_id', $org->id)->distinct()->count() < 3) {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');
            }

            $team_member_count = DB::table('teams')
                ->join('team_members', function($join) use ($org)  {

                    $join->on('teams.id', '=', 'team_members.team_id')
                        ->where('teams.organization_id', '=', $org->id);
                })
                ->count();
            $matchMale = array(
                'organization_id' => $org->id,
                'gender'          => 'Male'
            );

            $matchFemale = array(
                'organization_id' => $org->id,
                'gender'          => 'Female'
            );


            if (Team::where($matchMale)->count() < 2 ||  Team::where($matchFemale)->count() < 2 || $team_member_count < 24) {


                return redirect('/team')->with('team_not_filled', 'Please, enter the details of at least four teams: two of Male and two of Female and at least six members for each teams before you can continue.');

            }
            $data['organization'] = $org;


            $data['scouter'] = $data['organization']->scouters->count();
            $data['scout']   = $team_member_count;
            $data['member']  = intval($data['organization']->members->count() + 1);
            $data['total']   = $data['scouter'] + $data['scout'] + $data['member'];
            return view('scouter.registration')->with($data);

        }

        return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

    }


    // create lead scouter
    /**
     * @param CreateScouterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateLeadScouter(CreateScouterRequest $request)
    {
        if($request->has('org_id')) {
            Scouter::create([
                'name'              => $request->get('name'),
                'email'             => $request->get('email'),
                'permission'        => $request->get('permission'),
                'permission_date'   => $request->has('permission_date') ? formatDate($request->get('permission_date')) : null,
                'btc_no'            => $request->get('btc_no'),
                'btc_date'          => $request->has('btc_date') ? formatDate($request->get('btc_date')) : null,
                'advance_no'        => $request->get('advance_no'),
                'advance_date'      => $request->has('advance_date') ? formatDate($request->get('advance_date')) : null,
                'alt_no'            => $request->get('alt_no'),
                'alt_date'          => $request->has('alt_date') ? formatDate($request->get('alt_date')) : null,
                'lt_no'             => $request->get('lt_no'),
                'lt_date'           => $request->has('lt_date') ? formatDate($request->get('lt_date')) : null,
                'is_lead'           => true,
                'organization_id'   => $request->get('org_id')
            ]);
            return redirect()->back()->with(['lead_created' => 'The Scout Master scouter has been created.']);
        } else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }
    }

    // Create assistant scouter
    /**
     * @param CreateScouterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateScouterRequest $request)
    {

        if($request->has('org_id')) {

            Scouter::create([
                'name'              => $request->get('name'),
                'email'             => $request->get('email'),
                'permission'        => $request->get('permission'),
                'permission_date'   => $request->has('permission_date') ? formatDate($request->get('permission_date')) : null,
                'btc_no'            => $request->get('btc_no'),
                'btc_date'          => $request->has('btc_date') ? formatDate($request->get('btc_date')) : null,
                'advance_no'        => $request->get('advance_no'),
                'advance_date'      => $request->has('advance_date') ? formatDate($request->get('advance_date')) : null,
                'alt_no'            => $request->get('alt_no'),
                'alt_date'          => $request->has('alt_date') ? formatDate($request->get('alt_date')) : null,
                'lt_no'             => $request->get('lt_no'),
                'lt_date'           => $request->has('lt_date') ? formatDate($request->get('lt_date')) : null,
                'organization_id'   => $request->get('org_id')
            ]);
            return redirect()->back()->with(['scouter_created' => 'The Assistant Scout Master has been created.']);
        } else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }

    }

    /**
     * @param UpdateScouterRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchLead(UpdateScouterRequest $request, $id)
    {

        if($id){
            $scouter = Scouter::findOrFail($id);
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
                ->with(['lead_scouter_updated' => 'Scout Master successfully updated']);
        }
    }

    /**
     * @param UpdateScouterRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchScouter(UpdateScouterRequest $request, $id)
    {
        if($id){
            $scouter = Scouter::findOrFail($id);
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
                ->with(['scouter_updated' => 'Assistant Scout Master successfully updated']);
        }

    }


    /**
     * @return mixed
     */
    public function getPrint()
    {

        $data['title']  = 'Nepal Scout - Print';
        $org = Organization::where('user_id', $this->user->id)->first();
        if($org) {

            $data['org_id']       = $org->id;
            $data['organization'] = Organization::findOrFail($org->id);
            $data['district']     = $data['organization']->district;
            $data['member']       = $data['organization']->members->all();
            $data['team']         = $data['organization']->teams->all();
            $data['leadScouter']  = $data['organization']->scouters->where('is_lead', 1)->first();
            $data['scouter']      = $data['organization']->scouters->where('is_lead', 0)->first();
            $data['team_member']  = DB::table('teams')
                ->where('organization_id', $data['org_id'])
                ->join('team_members', 'teams.id', '=', 'team_members.team_id')
                ->select('teams.name as team_name', 'team_members.*')
                ->get();
            $data['rates']        = Rate::first();
            $data['scouter_no']   = $data['organization']->scouters->count();
            $data['scout_no']     = count($data['team']);
            $data['member_no']    = intval($data['organization']->members->count() + 1);
            $data['total']        = intval($data['scouter_no'] + $data['scout_no'] + $data['member_no']);
            $data['terms']        = Term::orderBy('order', 'ASC')->get();

            return view('scouter.print')->with( $data );

        }
    }


    public function getProfile($id)
    {
       if (Auth::user()->id == User::find($id)->id){
           $data['title'] = 'Nepal Scout - Profile';
           $data['user']  = User::findOrFail($id);
           if($data['user']->verified == 1){
               return view('scouter.profile')->with( $data );
           }
       }
        
    }

    public function patchProfile(UpdateScouterProfileRequest $request, $id)
    {
        if($id){
            $user = User::findOrFail($id);
            if($user){
            $user->f_name            = $request->get('f_name');
            $user->l_name            = $request->get('l_name');
            $user->password          = bcrypt($request->get('password'));

            $user->save();
        }


            return redirect()->back()
                ->with(['user_update' => 'User successfully updated']);

        }
        
    }

}
