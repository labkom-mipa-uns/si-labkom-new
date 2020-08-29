<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    /**
     * @var string
     */
    protected $table = 'dosen';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
