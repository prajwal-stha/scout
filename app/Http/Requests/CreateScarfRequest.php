<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateScarfRequest extends Request
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
            'background_colour'     => 'required',
            'border_colour'         => 'required',
        ];
    }
}
