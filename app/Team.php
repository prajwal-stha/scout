<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Teams
 * @package App
 */
class Teams extends Model
{

    /**
     * @var string
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizations()
    {
        return $this->belongsTo(Organizations::class);

    }
}
