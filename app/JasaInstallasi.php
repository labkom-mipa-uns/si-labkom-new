<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JasaInstallasi extends Model
{
    protected $table = 'jasa_installasi';
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function software(): BelongsTo
    {
        return $this->belongsTo(Software::class, 'id_software');
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
