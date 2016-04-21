<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateDistrictsRequest extends Request
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
            'district_code' => 'required|unique:districts,district_code',
            'name'          => 'required|unique:districts,name'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('districts');

    }
}
