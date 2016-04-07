<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rate
 * @package App
 */
class Rate extends Model
{

    protected $table = 'rates';
    /**
     * @var string
     */
    public $timestamps = false;


    protected $fillable = array( 'registration_rate', 'scouter_rate', 'team_rate', 'committee_members_rate', 'disaster_mgmt_trust_rate');

    // Accessor
    public function getRegistrationRateAttribute($value)
    {
        return $this->attributes['registration_rate'] = 'Rs. ' . $value;
    }

    public function getScouterRateAttribute($value)
    {
        return $this->attributes['scouter_rate'] = 'Rs. ' . $value;

    }

    public function getTeamRateAttribute($value){
        return $this->attributes['team_rate'] = 'Rs. ' . $value;
    }

    public function getCommitteeMembersRateAttribute($value)
    {
        return $this->attributes['committee_members_rate'] = 'Rs. ' . $value;

    }

    public function getDisasterMgmtTrustRateAttribute($value)
    {

        return $this->attributes['disaster_mgmt_trust_rate'] = 'Rs. ' . $value;

    }
    // Mutator

    public function setRegistrationRateAttribute($value)
    {
        $this->attributes['registration_rate'] = strip_tags(trim($value, 'Rs. '));
    }

    public function setScouterRateAttribute($value)
    {
        $this->attributes['scouter_rate'] = strip_tags(trim($value, 'Rs. '));

    }

    public function setTeamRateAttribute($value){
        $this->attributes['team_rate'] = strip_tags(trim($value, 'Rs. '));
    }

    public function setCommitteeMembersRateAttribute($value)
    {
        $this->attributes['committee_members_rate'] = strip_tags(trim($value, 'Rs. '));

    }

    public function setDisasterMgmtTrustRateAttribute($value)
    {

        $this->attributes['disaster_mgmt_trust_rate'] = strip_tags(trim($value, 'Rs. '));

    }

    public function formRegistrationRateAttribute($value)
    {
       return 'Rs. ' . $value;
    }

    public function formScouterRateAttribute($value)
    {
        return 'Rs. ' . $value;

    }

    public function formTeamRateAttribute($value){
        return 'Rs. ' . $value;
    }

    public function formCommitteeMembersRateAttribute($value)
    {
        return 'Rs. ' . $value;

    }

    public function formDisasterMgmtTrustRateAttribute($value)
    {

        return 'Rs. ' . $value;

    }
}
