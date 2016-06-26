<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'f_name', 'l_name', 'email', 'verified', 'token', 'level', 'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


//    public function setPasswordAttribute($value)
//    {
//        $this->attributes['password'] = bcrypt($value);
//    }

    public function organizations(){
        return $this->hasMany(Organization::class);
    }

    public function core_organizations(){
        return $this->hasMany(CoreOrganization::class);
    }

    public function scopePublic($query)
    {
        return $query->where('level', 0);
    }


    public function scopeVerified($query)
    {
        return $query->where('verified', 1);
    }


}
