<?php

namespace App\Models;

use App\Events\EventPeminjamanAlatSaved;
use App\Events\EventPeminjamanAlatUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanAlat extends Model
{
    use SoftDeletes;

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

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('tanggal_pinjam', 'like', "%$search%")
                    ->orWhere('tanggal_kembali', 'like', "%$search%")
                    ->orWhere('jam_pinjam', 'like', "%$search%")
                    ->orWhere('jam_kembali', 'like', "%$search%")
                    ->orWhere('jumlah_pinjam', 'like', "%$search%")
                    ->orWhere('keperluan', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('mahasiswa', function ($query) use ($search) {
                        $query->where('nama_mahasiswa','like', "%$search%");
                    })->orWhereHas('alat', function ($query) use ($search) {
                        $query->where('nama_alat', 'like', "%$search%");
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
