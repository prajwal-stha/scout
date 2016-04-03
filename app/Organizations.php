<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{

    public function teams(){

        return $this->hasMany(Teams::class);

    }

    public function scouter()
    {
        return $this->hasMany(Scouter::class);

    }

    public function districts()
    {
        return $this->belongsTo(Districts::class, 'district_code');

    }

}
