<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'software';
    protected $guarded = ['id'];

    public function jasainstallasi()
    {
        return $this->hasMany(JasaInstallasi::class);
    }
}
