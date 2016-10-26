<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App
 */
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
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations(){
        return $this->hasMany(Organization::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function core_organizations(){
        return $this->hasMany(CoreOrganization::class);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmin($query)
    {
        return $query->where('level', 1);

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query->where('level', 0);
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        if($this->level == 1){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        if($this->level == 0){
            return true;
        }
        return false;
        
    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        if($this->verified == 1){
            return true;
        }
        return false;

    }
}