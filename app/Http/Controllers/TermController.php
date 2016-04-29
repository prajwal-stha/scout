<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateTermsRequest;

use App\Term;
use Validator;

/**
 * Class TermController
 * @package App\Http\Controllers
 */
class TermController extends Controller
{
    /**
     * TermController constructor.
     */
    public function __construct(){

        $this->middleware(['auth', 'role']);

    }
    /**
     *
     */
    public function getIndex(){
        $data['title']  = 'Nepal Scout - Terms and Conditions';
        $data['terms'] = Term::all();
        return view('admin.terms')->with($data);
        
    }

    /**
     * @param CreateTermsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateTermsRequest $request)
    {
        Term::create(
            [
                'title'         => $request->get('title'),
                'terms'         => $request->get('terms'),
                'order' => $request->get('order')
            ]
        );

        return redirect()->back()
            ->with('terms_created', 'One more terms has been added.' );
        
    }

    /**
     *
     */
    public function getUpdate($id)
    {
        $term = Term::findOrFail($id);
        $response = array(
            'status'    => 'success',
            'term'  => $term
        );
        return response()->json($response);
        
    }

    public function patchUpdate(Request $request)
    {
        $rules = array(
            'title' => 'required|unique:terms,title,'.$request->get('id'),
            'terms'  => 'required',
            'order' => 'required|unique:terms,order,'.$request->get('id')
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

            if($id) {
                $term = Term::findOrFail($id);
                $input = $request->all();

                $term->fill($input)->save();

                $response = array(
                    'status'   => 'success',
                    'msg'      => 'Term successfully updated.',
                    'term' => $term
                );
            }
        }
        return response()->json($response);
        
    }

    public function getDelete($id)
    {
        $term = Term::findOrFail($id);
        if($term){
            Term::destroy($term->id);
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
            Term::destroy($request->get('action_to'));
            return redirect()->back();
        } else {

            return redirect()->back();
        }
        
    }
}
