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
            'core_organizations.name' => 10,
            'core_organizations.chairman_f_name' => 10,
            'core_organizations.chairman_l_name' => 10,
            'core_organizations.email' => 5,
            'districts.name'    => 10,
            'districts.district_code'   => 2
        ],
        'joins' => [
            'districts' => ['districts.id','core_organizations.district_id'],
        ],
    ];

    public function core_teams(){

        return $this->hasMany(CoreTeam::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(){
        return $this->hasMany(CoreMember::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scouters()
    {
        return $this->hasMany(CoreScouter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);

    }
}
