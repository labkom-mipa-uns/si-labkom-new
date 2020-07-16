<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminjamanAlat extends Model
{
    protected $table = 'peminjaman_alat';
    protected $guarded = ['id'];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with(['prodi']);
    }
}
