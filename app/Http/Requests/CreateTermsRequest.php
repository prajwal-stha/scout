<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTermsRequest extends Request
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
            'title' => 'required',
            'terms' => 'required',
            'display_order' => 'required|unique,terms,display_order'
        ];
    }
}
