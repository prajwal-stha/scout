<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class UpdateScouterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
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
            'permission'           => 'required_with:permission_date',
            'permission_date'      => 'required_with:btc_no|date_format:"d/m/Y"',
            'btc_no'               => 'required_with:btc_date',
            'btc_date'             => 'required_with:btc_no|date_format:"d/m/Y"',
            'advance_no'           => 'required_with:advance_date',
            'advance_date'         => 'required_with:advance_no|date_format:"d/m/Y"',
            'alt_no'               => 'required_with:alt_date',
            'alt_date'             => 'required_with:alt_no|date_format:"d/m/Y"',
            'lt_no'                => 'required_with:lt_date',
            'lt_date'              => 'required_with:lt_no|date_format:"d/m/Y"',
            'email'                => 'required|email',
            'org_id'               => 'required|exists:organizations,id'
        ];
    }
}
