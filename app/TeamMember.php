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
}
