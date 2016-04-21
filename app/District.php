<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    public $timestamps = false;

    protected $fillable = array('name', 'district_code');


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {

        return $this->hasMany( Organization::class );

    }

}
