<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $guarded = ['id'];

    public function peminjamanlab()
    {
        return $this->hasMany(PeminjamanLab::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
