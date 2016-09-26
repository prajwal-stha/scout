<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use App\Member;

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
            if(Member::where('organization_id', $this->get('organization_id'))->count() < 7) {
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
            'f_name'          => 'required',
            'l_name'          => 'required',
            'gender'          => 'required|string',
            'organization_id' => 'required|exists:organizations,id'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('scouter/committe')->withErrors('Commitee Member limit reached');

    }
}
