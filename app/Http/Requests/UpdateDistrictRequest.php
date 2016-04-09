<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateDistrictRequest extends Request
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
            'district_code' => 'required|unique:districts,district_code,'.$this->get('id'),
            'name'          => 'required|unique:districts,name,'.$this->get('id')
        ];

    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('districts')
            ->withErrors();

    }
}
