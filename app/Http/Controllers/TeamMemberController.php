<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateTeamMemberRequest;

use App\Team;

use App\TeamMember;

use Validator;

/**
 * Class TeamMemberController
 * @package App\Http\Controllers
 */
class TeamMemberController extends Controller
{


    /**
     * @param CreateTeamMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateTeamMemberRequest $request)
    {
        TeamMember::create([
            'f_name'         => $request->get('f_name'),
            'm_name'         => $request->get('m_name'),
            'l_name'         => $request->get('l_name'),
            'dob'            => formatDate($request->get('dob')),
            'entry_date'     => formatDate($request->get('entry_date')),
            'passed_date'    => formatDate($request->get('passed_date')),
            'note'           => $request->get('note'),
            'team_id'        => $request->get('team_id'),
            'position'       => $request->get('position')
        ]);

        return redirect()->back()->with(['team_member_created' => 'One of the team member has been created']);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $member = TeamMember::findOrFail($id);
        if($member){
            TeamMember::destroy($member->id);
        }
        return redirect()->back()->with('member_deleted', 'One of the member has been removed');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUpdate($id)
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
    public function patchUpdate(Request $request)
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

}
