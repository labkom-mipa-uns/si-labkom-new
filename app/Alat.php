<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $guarded = ['id'];

    public function peminjamanalat()
    {
        return $this->hasMany(PeminjamanAlat::class);
    }
}
