<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateDistrictRequest;


use App\District;

use Auth;
use Session;
use Validator;

/**
 * Class DistrictsController
 * @package App\Http\Controllers
 */
class DistrictsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function getIndex()
    {
        $districts = District::all();
        $title = 'Nepal Scout - Districts';
        return view('admin.districts', array('title' => $title, 'districts' => $districts));
    }

    /**
     */
    public function postCreate(Request $request)
    {

        if (Session::token() !== $request->get('_token')) {

            $response = array(
                'msg' => 'Unauthorized attempt to create districts'
            );

            return response()->json($response);

        }

        $rules = array(
            'district_code' => 'required|unique:districts,district_code',
            'name' => 'required|unique:districts,name'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg' => $validator->errors()->all()
            );

        } else {

            $district = District::create(
                [
                    'name'          => $request->get('name'),
                    'district_code' => $request->get('district_code'),
                ]
            );

            $response = array(
                'status' => 'success',
                'msg' => 'One more districts has been added.',
                'district' => $district
            );
        }

        return response()->json($response);
    }

    public function getUpdate($id)
    {
        $district = District::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'district'  => $district
        );
        return response()->json($response);

    }


    /**
     * @param UpdateDistrictRequest $request
     * @return $this
     */
    public function patchUpdate(UpdateDistrictRequest $request)
    {
        $id = $request->get('id');

        if($id){
            $district = District::findOrFail($id);
            $input = $request->all();

            $district->fill($input)->save();

            return redirect()->back()
                ->with(['district_updated' => 'District successfully updated']);
        }

    }

    public function getDelete($id)
    {
        $district = District::findOrFail($id);
        if($district){
            District::destroy($district->id);
            $response = array(
                'status' => 'success'
            );
        }else {
            $response = array(
                'status' => 'error'
            );
        }
        return response()->json($response);
    }

    public function postRemove(Request $request)
    {
        if ( is_array($request->get('action_to')) ){
            District::destroy($request->get('action_to'));
            return redirect()->back();
        } else {

            return redirect()->back();
        }
    }
}
