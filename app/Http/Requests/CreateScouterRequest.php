<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

use App\Scouter;

class CreateScouterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if(Scouter::where('organization_id', session()->get('org_id'))->count() < 2) {
                return TRUE;
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'                 => 'required',
            'btc_date'             => 'date',
            'advance_date'         => 'date',
            'alt_date'             => 'date',
            'lt_date'              => 'date',
            'email'                => 'required|email'
        ];
    }

}
