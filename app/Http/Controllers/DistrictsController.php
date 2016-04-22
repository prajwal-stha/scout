<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateDistrictsRequest;
use App\Http\Requests\UpdateDistrictRequest;


use App\District;

use Session;
use Validator;

/**
 * Class DistrictsController
 * @package App\Http\Controllers
 */
class DistrictsController extends Controller
{

    /**
     * DistrictsController constructor.
     */
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
     * @param CreateDistrictsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreate(CreateDistrictsRequest $request)
    {

//        if (Session::token() !== $request->get('_token')) {
//
//            $response = array(
//                'msg' => 'Unauthorized attempt to create districts'
//            );
//
//            return response()->json($response);
//
//        }
//
//        $rules = array(
//            'district_code' => 'required|unique:districts,district_code',
//            'name' => 'required|unique:districts,name'
//        );
//
//        $validator = Validator::make($request->all(), $rules);
//        // process the form
//        if ($validator->fails()) {
//            $response = array(
//                'status' => 'danger',
//                'msg' => $validator->errors()->all()
//            );
//
//        } else {

        District::create(
            [
                'name'          => $request->get('name'),
                'district_code' => $request->get('district_code'),
            ]
        );

        return redirect()->back()
            ->with('district_created', 'One more districts has been added.' );

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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
     * @param Request $request
     * @return $this
     */
    public function patchUpdate(Request $request)
    {

        $rules = array(
            'district_code' => 'required|unique:districts,district_code,'.$request->get('id'),
            'name'          => 'required|unique:districts,name,'.$request->get('id')
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            $response = array(
                'status' => 'danger',
                'msg'    => $validator->errors()->all()
            );

        } else {
            $id = $request->get('id');

            if($id) {
                $district = District::findOrFail($id);
                $input = $request->all();

                $district->fill($input)->save();

                $response = array(
                    'status'   => 'success',
                    'msg'      => 'District successfully updated.',
                    'district' => $district
                );

            }
        }
        return response()->json($response);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRemove(Request $request)
    {
        if ( is_array($request->get('action_to')) ){
            District::destroy($request->get('action_to'));
            return redirect()->back();
        } else {

            return redirect()->back();
        }
    }

    public function getAllDistricts()
    {
        $districts = District::all();

        return view('partials.districts')->withDistricts($districts);

    }

}
