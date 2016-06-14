<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateOrganizationsRequest;
use App\Http\Requests\UpdateOrganizationsRequest;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateScarfRequest;
use App\Http\Requests\SubmitFormRequest;


use App\Organization;
use App\Member;
use App\Scouter;
use App\Team;
use App\TeamMember;
use Session;
use Auth;
use Validator;
use DB;


/**
 * Class OrganizationsController
 * @package App\Http\Controllers
 */
class OrganizationsController extends Controller
{
    /**
     * OrganizationsController constructor.
     */
    public function __construct(){
        $this->middleware( ['auth', 'xss'] );
    }

    /**
     *
     * Creates new organization
     * @param CreateOrganizationsRequest $request
     * @return $this
     */
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
        return redirect('scouter/scarf')->with([
            'org_created'   => 'The organizations is succesfully created',
            'title'         => 'Nepal Scouts - Scarf'
        ]);
    }

    /**
     *
     * Post updated organization detail
     * @param UpdateOrganizationsRequest $request
     * @return $this
     */
    public function patchEdit(UpdateOrganizationsRequest $request, $id)
    {
        $org = Organization::findOrFail($id);
        if ($org) {
            $org->name = $request->get('name');
            $org->type = $request->get('type');
            $org->registration_date = $request->has('registration_date') ? formatDate($request->get('registration_date')) : null;
            $org->address_line_1 = $request->get('address_line_1');
            $org->address_line_2 = $request->has('address_line_2') ? $request->get('address_line_2') : '';
            $org->district_id = $request->get('district');
            $org->chairman_f_name = $request->get('chairman_f_name');
            $org->chairman_l_name = $request->get('chairman_f_name');
            $org->chairman_mobile_no = $request->get('chairman_mobile_no');
            $org->tel_no = $request->get('tel_no');
            $org->email = $request->get('email');
            $org->save();
        }

        return redirect()->back()
            ->with(['org_update' => 'Organization successfully updated']);

    }


    /**
     *
     * Creates new scarf details
     * @param CreateScarfRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postScarf(CreateScarfRequest $request)
    {
        if($request->has('org_id')) {

            Organization::where('id', $request->get('org_id'))
                ->update([
                    'background_colour' => $request->get('background_colour'),
                    'border_colour'     => $request->get('border_colour')
                ]);

            return redirect('scouter/committe');

        }
        else{
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }
    }


    /**
     *
     * Post updated details of scarf
     * @param $id
     * @param CreateScarfRequest $request
     * @return $this
     */
    public function patchEditScarf($id, CreateScarfRequest $request)
    {
        $org = Organization::findOrFail($id);

        $input = $request->all();

        $org->fill($input)->save();
        return redirect()->back()
            ->with(['scarf_update' => 'Scarf successfully updated'])
            ->withInput();

    }


    /**
     *
     * Creates new member
     * @param CreateMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMember(CreateMemberRequest $request)
    {
        if($request->has('organization_id')) {
            Member::create([
                'f_name'            => $request->get('f_name'),
                'm_name'            => $request->get('m_name'),
                'l_name'            => $request->get('l_name'),
                'organization_id'   => $request->get('organization_id')
            ]);

           return redirect()->back()->with(['member_created' => 'One of the member has been added to your organization']);

        } else {
            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);
        }
    }


    /**
     *
     * Remove the member in bulk
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRemove(Request $request)
    {
        if ( is_array($request->get('action_to')) ){
            Member::destroy($request->get('action_to'));
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


    /**
     *
     * Removes single member from the list
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDeleteMember($id)
    {
        $member = Member::findOrFail($id);
        if($member){
            Member::destroy($member->id);
        }
        return redirect()->back();
        
    }


    /**
     *
     * Populate the edit form for member update
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUpdateMember($id)
    {
        $member = Member::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'member'    => $member
        );
        return response()->json($response);

    }


    /**
     *
     * Post the updated detail of member
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patchUpdateMember(Request $request)
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

//                return redirect()->back()
//                    ->with(['member_updated' => 'Member successfully updated']);

            }
//            return redirect()->back()
//                ->with(['district_updated' => 'District successfully updated']);
        }
        return response()->json($response);
//        $id = $request->get('id');
//
//        if($id){
//            $member = Member::findOrFail($id);
//            $input = $request->all();
//
//            $member->fill($input)->save();
//
//            return redirect()->back()
//                ->with(['member_updated' => 'Member successfully updated']);
//        }
        
    }

    public function patchSubmit(Request $request)
    {
        if(session()->has('org_id')) {
            if (Member::where('organization_id', session()->get('org_id'))->distinct()->count() < 3) {

                return redirect('/committe')->with('member_not_filled', 'Please Enter the details of at least three committe members.');
            }

            if (Scouter::where('organization_id', session()->get('org_id'))
                    ->where('is_lead', 1)->count() != 1){
                return redirect('/lead-scouter')->with('lead_not_filled', 'Please Enter the details of the Lead Scouter first.');

            }

            if (Scouter::where('organization_id', session()->get('org_id'))
                    ->where('is_lead', 0)->count() != 1){
                return redirect('/scouter')->with('scouter_not_filled', 'Please Enter the details of the Assistant-Lead Scouter');

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
            $id = $request->get('organization_id');

            $org = Organization::findOrFail($id);
            if($org) {

                $org->is_submitted = true;
                $org->save();
                return redirect('scouter')->with(['org_submitted' => 'Your request has been submitted']);
            }
        }else {

            return redirect('scouter')->with(['no_org' => 'Please fill up this form first to continue.']);


        }


    }

}
