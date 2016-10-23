<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'f_name'   => 'required|max:255',
            'l_name'   => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'username' => 'required|max:255|unique:users,username|alpha_dash',
            'password' => 'required|min:6|confirmed',
            'level'    => 'required|integer'

        ];
    }
}
