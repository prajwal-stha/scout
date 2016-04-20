<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Teams
 * @package App
 */
class Team extends Model
{

    /**
     * @var string
     */
    public $timestamps = false;


    protected $fillable = ['name', 'organization_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizations()
    {
        return $this->belongsTo(Organizations::class);

    }

    public function teammembers()
    {
        return $this->hasMany(TeamMember::class);
        
    }
}
