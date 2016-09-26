<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * @package App
 */
class District extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = array('name', 'district_code');


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {

        return $this->hasMany( Organization::class );

    }


}
