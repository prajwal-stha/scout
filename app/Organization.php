<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organizations
 * @package App
 */
class Organization extends Model
{

    /**
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = array('registration_no', 'district_id', 'registration_date', 'renew_status', 'type', 'name', 'chairman_f_name', 'chairman_l_name', 'chairman_mobile_no', 'tel_no', 'address_line_1', 'address_line_2', 'email', 'user_id', 'background_colour', 'border_colour');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams(){

        return $this->hasMany(Team::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(){
        return $this->hasMany(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scouters()
    {
        return $this->hasMany(Scouter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {

        return $this->belongsTo(District::class);

    }

    public function get_attributes(){
        return $this->fillable;
    }


    public function user()
    {
        return $this->belongsTo(User::class);

    }
    /**
     * Accessor for Registration Date Attribute
     * @param $value
     * @return string
     */
    public function getRegistrationDateAttribute($value)
    {

        if($value) {
            $value = explode('-', $value);

            if(count($value) == 3){

                $value = $value[2] . '/' . $value[1] . '/' . $value[0];

                return $this->attributes['registration_date'] = Carbon::parse($value);
            }

            return '';

        }
    }


}
