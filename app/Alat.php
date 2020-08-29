<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alat extends Model
{
    /**
     * @var string
     */
    protected $table = 'alat';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function peminjamanalat(): HasMany
    {
        return $this->hasMany(PeminjamanAlat::class);
    }
}
