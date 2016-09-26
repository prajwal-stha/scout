<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class CoreScouter extends Model
{
    use SearchableTrait;
    protected $table = 'core_scouters';

    protected $fillable = [
        'original_id',
        'name',
        'btc_no',
        'btc_date',
        'advance_no',
        'advance_date',
        'alt_no',
        'alt_date',
        'lt_no',
        'lt_date',
        'permission',
        'permission_date',
        'is_lead',
        'email',
        'organization_id'
    ];

    protected $searchable = [
        'columns' => [
            'core_scouters.name'        => 10,
            'core_scouters.email'       => 10,
            'core_organizations.name' => 10
        ],
        'joins' => [
            'core_organizations'      => ['core_scouters.organization_id','core_organizations.original_id'],
        ],
    ];

    public function core_organization(){

        return $this->belongsTo(CoreOrganization::class, 'organization_id', 'original_id');

    }

    /**
     * @param $value
     * @return string
     */
    public function getPermissionDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['permission_date'] = $value;
            }

            return '';

        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getBtcDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['btc_date'] = $value;
            }

            return '';

        }

    }

    /**
     * @param $value
     * @return string
     */
    public function getAdvanceDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['advance_date'] = $value;
            }

            return '';

        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getAltDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['alt_date'] = $value;
            }

            return '';

        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getLtDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['lt_date'] = $value;
            }

            return '';

        }
    }

}
