<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{

    protected $table = 'team_members';

    public $timestamps = false;

    protected $fillable = ['f_name', 'm_name', 'l_name', 'dob', 'entry_date', 'position', 'passed_date', 'note', 'team_id' ];


    public function team()
    {
        return $this->belongsTo(Team::class);

    }

    public function getDobAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);
            $value = $value[2] . '/' . $value[1] . '/' . $value[0];
            return $this->attributes['dob'] = $value;
        }
    }

    public function getEntryDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);
            $value = $value[2] . '/' . $value[1] . '/' . $value[0];
            return $this->attributes['entry_date'] = $value;
        }
    }

    public function getPassedDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);
            $value = $value[2] . '/' . $value[1] . '/' . $value[0];
            return $this->attributes['passed_date'] = $value;
        }
    }


}
