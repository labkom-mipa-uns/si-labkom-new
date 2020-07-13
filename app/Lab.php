<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = 'lab';
    protected $guarded = ['id'];

    public function peminjamanlab()
    {
        return $this->hasMany(PeminjamanLab::class);
    }

}
