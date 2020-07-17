<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratBebasLabkom extends Model
{
    protected $table = 'surat_bebas_labkom';
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with(['prodi']);
    }
}
