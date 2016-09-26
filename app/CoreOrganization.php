<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class CoreOrganization extends Model
{

    use SearchableTrait;

    protected $table = 'core_organizations';

    protected $fillable = [
        'original_id',
        'registration_no',
        'district_id',
        'registration_date',
        'renew_status',
        'type', 'name',
        'chairman_f_name',
        'chairman_l_name',
        'chairman_mobile_no',
        'chairman_gender',
        'tel_no',
        'address_line_1',
        'address_line_2',
        'email',
        'user_id',
        'background_colour',
        'border_colour'
    ];


    protected $searchable = [
        'columns' => [
            'core_organizations.registration_no' => 10,
            'core_organizations.name'            => 10,
            'core_organizations.chairman_f_name' => 10,
            'core_organizations.chairman_l_name' => 10,
            'core_organizations.email'           => 5,
            'core_organizations.type'            => 5,
            'districts.name'                     => 2,
            'districts.district_code'            => 2
        ],
        'joins' => [
            'districts'      => ['core_organizations.district_id','districts.id'],
        ],
    ];

    public function core_teams(){

        return $this->hasMany(CoreTeam::class, 'organization_id', 'original_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function core_members(){
        return $this->hasMany(CoreMember::class, 'organization_id', 'original_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function core_scouters()
    {
        return $this->hasMany(CoreScouter::class, 'organization_id', 'original_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getRegistrationDateAttribute($value)
    {
        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['registration_date'] = $value;
            }

            return '';

        }
    }
}
