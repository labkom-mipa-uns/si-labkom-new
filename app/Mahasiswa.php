<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guarded = ['id'];

    public function peminjamanlab()
    {
        return $this->hasMany(PeminjamanLab::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function suratbebaslabkom()
    {
        return $this->hasMany(SuratBebasLabkom::class);
    }

    public function jasainstallasi()
    {
        return $this->hasMany(JasaInstallasi::class);
    }
}
