<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scouter extends Model
{

    public function organizations(){

        return $this->belongsTo(Organizations::class, 'organization_id');

    }

}
