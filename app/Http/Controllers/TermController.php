<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateTermsRequest;

use App\Term;

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
                'display_order' => $request->get('display_order')
            ]
        );

        return redirect()->back()
            ->with('terms_created', 'One more terms has been added.' );
        
    }

    /**
     *
     */
    public function getUpdate()
    {
        
    }

    public function patchUpdate()
    {
        
    }

    public function getDelete()
    {
        
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
