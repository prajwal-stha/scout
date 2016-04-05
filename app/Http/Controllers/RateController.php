<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\CreateRateRequest;
use App\Rate;

class RateController extends Controller
{
    public function getIndex()
    {
        $data['title'] = 'Nepal Scout - Rates';
        return view('admin.rate', $data);
        
    }

    public function getCreateRate()
    {
        
    }

    public function postCreateRate(CreateRateRequest $request)
    {
        
    }

    public function getEditRate()
    {
        
    }

    public function patchEditRate()
    {
        
    }
}
