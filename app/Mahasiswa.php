<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    /**
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function peminjamanlab(): HasMany
    {
        return $this->hasMany(PeminjamanLab::class);
    }

    /**
     * @return BelongsTo
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    /**
     * @return HasMany
     */
    public function suratbebaslabkom(): HasMany
    {
        return $this->hasMany(SuratBebasLabkom::class);
    }

    /**
     * @return HasMany
     */
    public function jasainstallasi(): HasMany
    {
        return $this->hasMany(JasaInstallasi::class);
    }
}
