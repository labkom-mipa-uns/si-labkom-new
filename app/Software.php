<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Software extends Model
{
    protected $table = 'software';
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function jasainstallasi(): HasMany
    {
        return $this->hasMany(JasaInstallasi::class);
    }
}
