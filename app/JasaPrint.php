<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JasaPrint extends Model
{
    protected $table = 'jasa_print';
    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
