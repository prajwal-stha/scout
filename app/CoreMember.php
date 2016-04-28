<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreMember extends Model
{
    protected $table = 'core_organization_commitee_members';

    protected $fillable = ['original_id', 'f_name', 'm_name', 'l_name', 'organization_id'];


    public function core_organization(){

        return $this->belongsTo(CoreOrganization::class, 'original_id');

    }

    public function get_table(){
        return $this->table;
    }
}
