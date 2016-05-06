<?php

namespace App\Http\Controllers;

use App\TeamMember;
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

    /**
     * ScouterController constructor.
     */
    public function __construct(){

        $this->middleware('auth');

    }


    /**
     * @return $this
     */
    public function getIndex(){
        $data['district'] = District::all();
        $data['title']    = 'Nepal Scout - Organizations';
        if(session()->has('org_id')){
            $data['org_id'] = session()->get('org_id');
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));
        }
        return view('scouter.organization')->with($data);

    }

    /**
     * @return $this
     */
    public function getScarf(){
        $data['title']   = 'Nepal Scout - Scarf';
        if(session()->has('org_id')){

            $data['org_id'] = session()->get('org_id');
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));
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

        if(session()->has('org_id')){

            $data['org_id']        = session()->get('org_id');
            if(Member::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();
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
        if(session()->has('org_id')) {
            $data['org_id']        = session()->get('org_id');
            if(Member::where( 'organization_id', session()->get('org_id'))->distinct()->count() >= 3) {

                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();

            } else {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if(Scouter::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                $data['scouter']  = Scouter::where('organization_id', session()->get('org_id'))
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

        if(session()->has('org_id')) {
            $data['org_id'] = session()->get('org_id');
            if (Member::where('organization_id', session()->get('org_id'))->distinct()->count() >= 3) {
                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();
            }else{

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if (Scouter::where('organization_id', session()->get('org_id'))
                    ->where('is_lead', true)->count() > 0) {
                $data['leadScouter'] = Scouter::where('organization_id', session()->get('org_id'))
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
        if(session()->has('org_id')) {
            if (is_null($teamId)) {

                $data['org_id'] = session()->get('org_id');
                if (Team::where('organization_id', session()->get('org_id'))->count() > 0) {
                    $data['team'] = Team::where('organization_id', session()->get('org_id'))->get();
                    $data['teamId'] = $data['team']->first()->id;
                    if ($data['teamId']) {
                        $data['team_member'] = TeamMember::where('team_id', $data['teamId'])->get();
                        $data['team_name'] = Team::findOrFail($data['teamId'])->name;
                    }
                }

            } else {

                $data['org_id'] = session()->get('org_id');
                if (Team::where('organization_id', session()->get('org_id'))->count() > 0) {
                    $data['team'] = Team::where('organization_id', session()->get('org_id'))->get();
                    $data['team_member'] = TeamMember::where('team_id', $teamId)->get();
                    $data['teamId'] = $teamId;
                    $data['team_name'] = Team::findOrFail($teamId)->name;
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

        if(session()->has('org_id')) {
            if (Member::where('organization_id', session()->get('org_id'))->distinct()->count() < 3) {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');
            }

            $team_member_count = DB::table('teams')
                ->join('team_members', function ($join) {
                    $join->on('teams.id', '=', 'team_members.team_id')
                        ->where('teams.organization_id', '=', session()->get('org_id'));
                })
                ->count();


            if (Team::where('organization_id', session()->get('org_id'))->count() < 4 || $team_member_count < 24) {

                return redirect('/team')->with('team_not_filled', 'Please, enter the details of at least four teams and at least six members for each teams before we can continue.');

            }
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));


            $data['scouter'] = intval(Scouter::where('organization_id', session()->get('org_id'))->count());
            $data['scout'] = $team_member_count;
            $data['member'] = intval(Member::where('organization_id', session()->get('org_id'))->count());
            $data['total']  = $data['scouter'] + $data['scout'] + $data['member'];
            return view('scouter.registration')->with($data);

        }

        return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);



        
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
            return redirect()->back()->with(['scouter_created' => 'The assistant scouter has been created.']);
        } else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }
        
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
            return redirect()->back()->with(['lead_created' => 'The lead scouter has been created.']);
        } else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

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
                ->with(['scouter_updated' => 'Assistant Lead Scouter successfully updated']);
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
                ->with(['lead_scouter_updated' => 'Lead Scouter successfully updated']);
        }
    }

    /**
     * @return mixed
     */
    public function getPrint()
    {

        $data['title']  = 'Nepal Scout - Print';
        if(session()->has('org_id')) {

            $data['org_id']       = session()->get('org_id');
            $data['organization'] = Organization::findOrFail(session()->get('org_id'));
            $data['district']     = $data['organization']->district;
            $data['member']       = $data['organization']->members->all();
            $data['team']         = $data['organization']->teams->all();
            $data['leadScouter']  = Scouter::where('organization_id', session()->get('org_id'))
                ->where('is_lead', 1)
                ->first();
            $data['scouter'] = Scouter::where('organization_id', session()->get('org_id'))
                ->where('is_lead', 0)
                ->first();
            $data['team_member'] = DB::table('teams')
                ->where('organization_id', $data['org_id'])
                ->join('team_members', 'teams.id', '=', 'team_members.team_id')
                ->select('teams.name as team_name', 'team_members.*')
                ->get();
            $data['rates']        = Rate::first();
            $data['scouter_no']   = intval(Scouter::where('organization_id', $data['org_id'])->count());
            $data['scout_no']     = intval(count($data['team']));
            $data['member_no']    = intval(Member::where('organization_id', $data['org_id'])->count() + 1);
            $data['total']        = intval($data['scouter_no'] + $data['scout_no'] + $data['member_no']);
            $data['terms']        = Term::orderBy('order', 'ASC')->get();

            return view('scouter.print')->with( $data );

        }
    }


    public function getProfile($id)
    {
       if (Auth::user()->id == User::find($id)->id){
           $data['title'] = 'Nepal Scout - Profile';
           $data['user'] = User::findOrFail($id);
           if($data['user']->verified == 1){
               return view('scouter.profile')->with( $data );
           }
       }
        
    }

    public function patchProfile(UpdateScouterProfileRequest $request, $id)
    {
        if($id){
            $user = User::findOrFail($id);

            $input = $request->all();

            $user->fill($input)->save();

            return redirect()->back()
                ->with(['user_update' => 'User successfully updated']);

        }
        
    }

}
