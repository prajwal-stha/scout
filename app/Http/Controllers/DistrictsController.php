<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateDistrictsRequest;

use App\Districts;

use Auth;
use Session;
use Validator;

/**
 * Class DistrictsController
 * @package App\Http\Controllers
 */
class DistrictsController extends Controller
{

    /**
     *
     */
    public function getIndex()
    {
        $districts = Districts::all();
        $title = 'Nepal Scout - Districts';
        return view('admin.districts', array('districts' => $districts, 'title' => $title));

        
    }

    /**
     *
     */
    public function getCreateDistricts()
    {

    }

    /**
     */
    public function postCreateDistricts(Request $request)
    {
//        Districts::create
//        (
//            [
//                'name'            => $request->get('name'),
//                'district_code'   => $request->get('district_code'),
//            ]
//        );
//
//        return Redirect::back()->with(['districts_created' => 'One more districts has been added.']);
        if ( Session::token() !== $request->get( '_token' ) ) {
            return response()->json( array(
                'msg' => 'Unauthorized attempt to create districts'
            ) );

        }

        $rules = array(
            'district_code' => 'required|unique:districts',
            'name'          => 'required|unique:districts'
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            Districts::create(
                [
                    'name'            => $request->get('name'),
                    'district_code'   => $request->get('district_code'),
                ]
            );

            $response = array(
                'status' => 'success',
                'msg' => 'One more districts has been added.',
            );
        }
        return response()->json( $response );
        
    }

    /**
     *
     */
    public function getEditDistricts()
    {

    }

    /**
     * @param CreateDistrictsRequest $request
     */
    public function patchEditDistricts(CreateDistrictsRequest $request, $code)
    {


    }

    public function getDeleteDistricts($code)
    {
        dd($code);

    }

    public function postDeleteManyDistricts(Request $request)
    {
        if ( null !== ($request->get('mass-delete')) && is_array($request->get('action_to')) ){
            Districts::destroy($request->get('action_to'));
        }
        return redirect()->back()->with(['districts_deleted' => 'The Districts has been deleted.']);

    }


}
