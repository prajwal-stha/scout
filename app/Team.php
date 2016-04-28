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


    /**
     * @var array
     */
    protected $fillable = ['name', 'organization_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
        
    }


    public function get_attributes(){
        return $this->fillable;
    }

}
