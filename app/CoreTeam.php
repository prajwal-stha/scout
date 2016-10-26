<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class CoreTeam
 * @package App
 */
class CoreTeam extends Model
{

    use SearchableTrait;
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
        'gender',
        'type',
        'organization_id'
    ];
    
    protected $searchable = [
        'columns' => [
            'core_teams.name'           => 10,
            'core_team_members.f_name'  => 10,
            'core_team_members.m_name'  => 10,
            'core_team_members.l_name'  => 10
        ],
        'joins' => [
            'core_team_members'      => ['core_teams.original_id','core_team_members.team_id'],
        ],
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function core_organization()
    {
        return $this->belongsTo(CoreOrganization::class, 'organization_id', 'original_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function core_team_members()
    {
        return $this->hasMany(CoreTeamMember::class, 'team_id', 'original_id');

    }
}