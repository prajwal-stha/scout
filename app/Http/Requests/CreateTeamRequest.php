<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

use App\Team;

class CreateTeamRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if(Team::where('organization_id', session()->get('org_id'))->count() < 4) {
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
            'name'              => 'required|unique:teams,name,NULL,id,organization_id,'.$this->get('org_id'),
            'org_id'            => 'required|exists:organizations,id'
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('scouter/team')->withErrors('Team limit has reached');

    }
}
