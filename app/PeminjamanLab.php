<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminjamanLab extends Model
{
    protected $table = 'peminjaman_lab';
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with('prodi');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'id_lab');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal')->with(['dosen','matakuliah','prodi']);
    }
}
