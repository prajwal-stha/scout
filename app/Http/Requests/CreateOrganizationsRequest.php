<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrganizationsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration_date'     => 'required',
            'type'                  => 'required',
            'name'                  => 'required|unique:organizations,name',
            'chairman_f_name'       => 'required',
            'chairman_l_name'       => 'required',
            'chairman_mobile_no'    => 'required',
            'tel_no'                => 'required',
            'address_line_1'        => 'required',
            'address_line_2'        => 'required',
            'email'                 => 'required|email|unique:organizations,email'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('districts')->withErrors();

    }

}
