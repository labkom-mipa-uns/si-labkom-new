<?php

namespace App;

use App\Events\EventJasaInstallasiSaved;
use App\Events\EventJasaInstallasiUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JasaInstallasi extends Model
{
    /**
     * @var string
     */
    protected $table = 'jasa_installasi';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => EventJasaInstallasiSaved::class,
        'updated' => EventJasaInstallasiUpdated::class,
    ];

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
