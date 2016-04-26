<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreScouter extends Model
{
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

    public function organization(){

        return $this->belongsTo(CoreOrganization::class, 'organization_id');

    }

}
