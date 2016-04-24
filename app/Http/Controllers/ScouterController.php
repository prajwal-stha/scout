<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateScouterRequest;
use App\Http\Requests\UpdateScouterRequest;

use Auth;

use App\Scouter;

use App\District;

use App\User;

use App\Member;
use App\Organization;

use App\Team;

use App\Rate;

use DB;

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
            if(Member::where( 'organization_id', session()->get('org_id'))->count() >= 3) {

                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();

            } else {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if(Scouter::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                $data['scouter']  = Scouter::where('organization_id', session()->get('org_id'))
                                    ->where('is_lead', 0)
                                    ->first();
            }

        }
        return view('scouter.scouter')->with($data);
        
    }

    public function getLeadScouter()
    {
        $data['title'] = 'Nepal Scout - Scouter';

        if(session()->has('org_id')) {
            $data['org_id'] = session()->get('org_id');
            if (Member::where('organization_id', session()->get('org_id'))->count() >= 3) {
                $data['member'] = Member::where('organization_id', session()->get('org_id'))->get();
            }else{

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at lease three committe members.');

            }

            if (Scouter::where('organization_id', session()->get('org_id'))
                    ->where('is_lead', true)->count() > 0
            ) {
                $data['leadScouter'] = Scouter::where('organization_id', session()->get('org_id'))
                    ->where('is_lead', 1)
                    ->first();
            }
        }

        return view('scouter.lead-scouter')->with($data);

    }

    public function getTeam($teamId = null)
    {
        $data['title'] = 'Nepal Scout - Scouter';
        if(is_null($teamId)){
            if(session()->has('org_id')) {
                $data['org_id']   = session()->get('org_id');
                if(Team::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                    $data['team'] = Team::where('organization_id', session()->get('org_id'))->get();
                    $data['teamId'] = $data['team']->first()->id;
                    if($data['teamId']) {
                        $data['team_member'] = TeamMember::where('team_id', $data['teamId'])->get();
                    }
                }
            }
        } else {
            if(session()->has('org_id')) {
                $data['org_id']   = session()->get('org_id');
                if(Team::where( 'organization_id', session()->get('org_id'))->count() > 0 ) {
                    $data['team'] = Team::where('organization_id', session()->get('org_id'))->get();
                    $data['team_member'] = TeamMember::where('team_id', $teamId)->get();
                    $data['teamId'] = $teamId;
                }
            }
        }
        return view('scouter.team')->with($data);
        
    }

    public function getRegistration()
    {
        $data['title']      = 'Registration Cost Detail';
        $data['rates']      = Rate::first();

        if(session()->has('org_id')) {
            $data['scouter'] = intval(Scouter::where('organization_id', session()->get('org_id'))->count());
//            $team = Team::where('organization_id', session()->get('org_id'))->get();
            $data['scout'] = intval(DB::table('teams')
                ->join('team_members', function ($join) {
                    $join->on('teams.id', '=', 'team_members.team_id')
                    ->where('teams.organization_id', '=', session()->get('org_id'));
                })
                ->count());
            $data['member'] = intval(Member::where('organization_id', session()->get('org_id'))->count());
            $data['total']  = $data['scouter'] + $data['scout'] + $data['member'];

        }



        return view('scouter.registration')->with($data);
        
    }
    
    // Create assistant scouter
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


    public function patchEdit(UpdateScouterRequest $request, $id)
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

    public function patchEditLead(UpdateScouterRequest $request, $id)
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
}
