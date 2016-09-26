<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRateRequest extends Request
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
            'registration_rate'        => 'required|integer',
            'scouter_rate'             => 'required|integer',
            'team_rate'                => 'required|integer',
            'committee_members_rate'   => 'required|integer',
            'disaster_mgmt_trust_rate' => 'required|integer',
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('rate');

    }
}
