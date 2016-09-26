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


    /**
     * @var array
     */
    protected $fillable = array( 'registration_rate', 'scouter_rate', 'team_rate', 'committee_members_rate', 'disaster_mgmt_trust_rate');



}
