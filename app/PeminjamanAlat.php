<?php

namespace App;

use App\Events\EventPeminjamanAlatSaved;
use App\Events\EventPeminjamanAlatUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeminjamanAlat extends Model
{
    /**
     * @var string
     */
    protected $table = 'peminjaman_alat';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => EventPeminjamanAlatSaved::class,
        'updated' => EventPeminjamanAlatUpdated::class
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
