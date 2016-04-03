<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    public function organizations()
    {

        return $this->hasMany( Organizations::class, 'district_code' );

    }
}
