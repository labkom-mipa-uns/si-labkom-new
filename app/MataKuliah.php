<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $guarded = ['id'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
