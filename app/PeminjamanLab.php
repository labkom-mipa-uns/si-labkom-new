<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanLab extends Model
{
    /**
     * @var string
     */
    protected $table = 'peminjaman_lab';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with('prodi');
    }

    /**
     * @return BelongsTo
     */
    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class, 'id_lab');
    }

    /**
     * @return BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal')->with(['dosen', 'matakuliah', 'prodi']);
    }
}
