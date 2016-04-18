<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateMemberRequest extends Request
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
            'f_name'    => 'required',
            'l_name'    => 'required'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('scouter/committe');

    }
}
