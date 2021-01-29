<?php

namespace App\Models;

use App\Events\EventJasaInstallasiSaved;
use App\Events\EventJasaInstallasiUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JasaInstallasi extends Model
{
    use SoftDeletes;

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

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('tanggal', 'like', "%$search%")
                    ->orWhere('jam_ambil', 'like', "%$search%")
                    ->orWhere('laptop', 'like', "%$search%")
                    ->orWhere('kelengkapan', 'like', "%$search%")
                    ->orWhere('jenis', 'like', "%$search%")
                    ->orWhere('tanggal', 'like', "%$search%")
                    ->orWhereHas('mahasiswa', function ($query) use ($search) {
                        $query->where('nama_mahasiswa','like', "%$search%");
                    })->orWhereHas('software', function ($query) use ($search) {
                        $query->where('nama_software', 'like', "%$search%");
                    });
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
