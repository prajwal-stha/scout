<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    protected $table   = 'organization_commitee_members';

    public $timestamps = false;

    protected $fillable = array('f_name', 'm_name', 'l_name', 'organization_id');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization(){

        return $this->belongsTo(Organization::class, 'organization_id');

    }

}
