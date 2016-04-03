<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{

    public function organizations()
    {
        return $this->belongsTo(Organizations::class);

    }
}
