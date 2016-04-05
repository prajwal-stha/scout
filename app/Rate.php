<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rate
 * @package App
 */
class Rate extends Model
{

    /**
     * @var string
     */
    public $timestamps = false;


    protected $fillable = array( 'registration_rate', 'scouter_rate', 'team_rate', 'committee_members_rate', 'disaster_mgmt_trust_rate');


    public function getRegistrationRateAttribute($value)
    {
        $this->attributes['registration_rate'] = 'Rs. ' . $value;
    }

    public function getScouterRateAttribute($value)
    {
        $this->attributes['scouter_rate'] = 'Rs. ' . $value;

    }

    public function getTeamRateAttribute($value){
        $this->attributes['team_rate'] = 'Rs. ' . $value;
    }

    public function getCommitteeMembersRateAttribute($value)
    {
        $this->attributes['committee_members_rate'] = 'Rs. ' . $value;

    }

    public function getDisasterMgmtTrustRateAttribute($value)
    {

        $this->attributes['disaster_mgmt_trust_rate'] = 'Rs. ' . $value;

    }
}
