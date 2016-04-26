<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreTeam
 * @package App
 */
class CoreTeam extends Model
{
    /**
     * @var string
     */
    protected $table = 'core_teams';

    /**
     * @var array
     */
    protected $fillable = [
        'original_id',
        'name',
        'organization_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(CoreOrganization::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teammembers()
    {
        return $this->hasMany(CoreTeamMember::class);

    }

}
