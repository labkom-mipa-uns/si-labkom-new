<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lab extends Model
{
    /**
     * @var string
     */
    protected $table = 'lab';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function peminjamanlab(): HasMany
    {
        return $this->hasMany(PeminjamanLab::class);
    }

}
