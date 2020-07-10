<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guarded = 'id';

    public function peminjamanlab()
    {
        return $this->hasMany(PeminjamanLab::class);
    }
}
