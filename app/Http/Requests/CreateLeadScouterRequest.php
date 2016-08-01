<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

use App\Scouter;

class CreateLeadScouterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if(Scouter::where('organization_id', $this->get('org_id'))->count() < 2) {
                return TRUE;
            }
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
            'lead_name'                 => 'required',
            'lead_btc_no'               => 'required_with:btc_date',
            'lead_btc_date'             => 'required_with:btc_no|date_format:"d/m/Y"',
            'lead_advance_no'           => 'required_with:advance_date',
            'lead_advance_date'         => 'required_with:advance_no|date_format:"d/m/Y"',
            'lead_alt_no'               => 'required_with:alt_date',
            'lead_alt_date'             => 'required_with:alt_no|date_format:"d/m/Y"',
            'lead_lt_no'                => 'required_with:lt_date',
            'lead_lt_date'              => 'required_with:lt_no|date_format:"d/m/Y"',
            'lead_email'                => 'required|email',
            'org_id'                    => 'required|exists:organizations,id'
        ];
    }

}
