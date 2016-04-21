<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateOrganizationsRequest extends Request
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
            'registration_date'     => 'required|date_format:"d/m/Y"',
            'type'                  => 'required|string',
            'name'                  => 'required|unique:organizations,name',
            'district'              => 'required|exists:districts,id',
            'chairman_f_name'       => 'required|string',
            'chairman_l_name'       => 'required|string',
            'chairman_mobile_no'    => 'required|string',
            'tel_no'                => 'required|string',
            'address_line_1'        => 'required|string',
            'address_line_2'        => 'string',
            'email'                 => 'required|email|unique:organizations,email'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('scouter')->withErrors();

    }

}
