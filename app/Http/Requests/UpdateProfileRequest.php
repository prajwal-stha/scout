<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(is_admin()){
            if(auth()->user()->id == $this->user()->id){
                return true;
            }

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
            'f_name'    => 'required|max:255',
            'l_name'    => 'required|max:255',
            'password'  => 'sometimes|required|min:6|confirmed',
        ];
    }
}
