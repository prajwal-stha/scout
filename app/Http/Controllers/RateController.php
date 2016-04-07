<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateRateRequest;
use App\Rate;

use Session;

class RateController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'auth' );

    }

    public function getIndex()
    {
        $data['title'] = 'Nepal Scout - Rates';
        $data['rates'] = Rate::first();
        return view('admin.rate')->with($data);
    }

    public function postCreate(CreateRateRequest $request)
    {
        Rate::create
        (
            [
                'registration_rate'            => $request->get('registration_rate'),
                'scouter_rate'                 => $request->get('scouter_rate'),
                'team_rate'                    => $request->get('team_rate'),
                'committee_members_rate'       => $request->get('committee_members_rate'),
                'disaster_mgmt_trust_rate'     => $request->get('disaster_mgmt_trust_rate'),
            ]
        );

        return redirect()->back()->withInput();
    }


    public function patchEdit($id, CreateRateRequest $request)
    {
        $rates = Rate::findOrFail($id);

        $input = $request->all();

        $rates->fill($input)->save();

        return redirect()->back()
            ->with(['rates_updated' => 'Rates successfully updated'])
            ->withInput();
        
    }


}
