<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreTeamMember
 * @package App
 */
class CoreTeamMember extends Model
{
    /**
     * @var string
     */
    protected $table = 'core_team_members';

    /**
     * @var array
     */
    protected $fillable = [
        'original_id',
        'f_name',
        'm_name',
        'l_name',
        'dob',
        'entry_date',
        'position',
        'passed_date',
        'note',
        'core_team_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(CoreTeam::class);

    }
}
