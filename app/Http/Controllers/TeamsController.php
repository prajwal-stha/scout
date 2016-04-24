<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

use App\Team;

use Validator;


class TeamsController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }

    public function postCreate(CreateTeamRequest $request){
        if($request->has('org_id')){
            Team::create([
                'name'              => $request->get('name'),
                'organization_id'   => $request->get('org_id')
            ]);
            return redirect()->back()->with(['team_created' => 'The team has been created.']);
        } else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);

        }

    }


    public function getRemove($id)
    {
        $team = Team::findOrFail($id);
        if($team){
            Team::destroy($team->id);
        }
        return redirect()->back()->with('team_deleted', 'One of the team has been removed');
        
    }

    public function getUpdate($id)
    {
        $team = Team::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'team'    => $team
        );
        return response()->json($response);

    }

    public function patchUpdate(Request $request){

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
}
