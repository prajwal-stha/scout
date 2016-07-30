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
        'post',
        'passed_date',
        'note',
        'team_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function core_team()
    {
        return $this->belongsTo(CoreTeam::class, 'original_id');

    }

    /**
     * @param $value
     * @return string
     */
    public function getDobAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['dob'] = $value;
            }

            return '';

        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getEntryDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['entry_date'] = $value;
            }

            return '';

        }

    }

    /**
     * @param $value
     * @return string
     */
    public function getPassedDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['passed_date'] = $value;
            }

            return '';

        }

    }
}
