<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{

//    protected $primaryKey = 'district_code';

    public $timestamps = false;

    protected $fillable = array('name');


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {

        return $this->hasMany( Organizations::class, 'district_code' );

    }

}
