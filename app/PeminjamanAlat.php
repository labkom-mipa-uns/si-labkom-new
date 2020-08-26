<?php

namespace App;

use App\Events\EventPeminjamanAlat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeminjamanAlat extends Model
{
    protected $table = 'peminjaman_alat';
    protected $guarded = ['id'];
    protected $dispatchesEvents = [
        'saved' => EventPeminjamanAlat::class
    ];

    /**
     * @return BelongsTo
     */
    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }

    /**
     * @return BelongsTo
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa')->with(['prodi']);
    }

    /**
     * @return HasMany
     */
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
