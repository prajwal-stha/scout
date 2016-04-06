<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRateRequest extends Request
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
            'registration_rate'        => 'integer',
            'scouter_rate'             => 'integer',
            'team_rate'                => 'integer',
            'committee_members_rate'   => 'integer',
            'disaster_mgmt_trust_rate' => 'integer',
        ];
    }

    public function forbiddenResponse()
    {
        return $this->redirector->to('/rate');

    }
}
