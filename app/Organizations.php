<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organizations
 * @package App
 */
class Organizations extends Model
{

    protected $table = 'organizations';
    /**
     * @var string
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams(){

        return $this->hasMany(Teams::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scouter()
    {
        return $this->hasMany(Scouter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function districts()
    {

        return $this->belongsTo(Districts::class);

    }

}
