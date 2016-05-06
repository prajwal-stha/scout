<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class CoreMember extends Model
{

    use SearchableTrait;
    protected $table = 'core_organization_commitee_members';

    protected $fillable = ['original_id', 'f_name', 'm_name', 'l_name', 'organization_id'];

    protected $searchable = [
        'columns' => [
            'core_organization_commitee_members.f_name'            => 10,
            'core_organization_commitee_members.m_name'            => 10,
            'core_organization_commitee_members.l_name'            => 10,
            'core_organizations.name'                              => 10
        ],
        'joins' => [
            'core_organizations'      => ['core_organizations.original_id','core_organization_commitee_members.organization_id'],
        ],
    ];


    public function core_organization(){

        return $this->belongsTo(CoreOrganization::class,  'organization_id', 'original_id');

    }

}
