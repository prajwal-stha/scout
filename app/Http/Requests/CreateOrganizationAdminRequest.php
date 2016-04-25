<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrganizationAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(is_admin()){
            return true;
        }
        return false;
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
            'name'                  => 'required|unique:organizations,name,'.$this->get('id'),
            'district'              => 'required|exists:districts,id',
            'chairman_f_name'       => 'required|string',
            'chairman_l_name'       => 'required|string',
            'chairman_mobile_no'    => 'required|string',
            'tel_no'                => 'required|string',
            'address_line_1'        => 'required|string',
            'address_line_2'        => 'string',
            'email'                 => 'required|email|unique:organizations,email,'.$this->get('id'),
            'background_colour'     => 'required',
            'border_colour'         => 'required',
        ];
    }
}
