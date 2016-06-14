<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

use App\Team;

use Validator;


/**
 * Class TeamsController
 * @package App\Http\Controllers
 */
class TeamsController extends Controller
{

    /**
     * TeamsController constructor.
     */
    public function __construct(){

        $this->middleware( ['auth', 'xss'] );

    }
    /**
     * @param CreateTeamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateTeamRequest $request){

        if($request->has('org_id')){
            Team::create(
                [
                    'name'            => $request->get('name'),
                    'organization_id' => $request->get('org_id')
                ]
            );
            return redirect()->back()
                ->with('team_created', 'One more team has been added.' );

        } else {
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemove($id)
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
    public function getUpdate($id)
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
