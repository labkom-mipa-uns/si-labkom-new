<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JasaInstallasi extends Model
{
    protected $table = 'jasa_installasi';
    protected $guarded = ['id'];

    public function software()
    {
        return $this->belongsTo(Software::class, 'id_software');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with(['prodi']);
    }
}
