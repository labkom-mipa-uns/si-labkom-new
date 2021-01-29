<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'jadwal';

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
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    /**
     * @return BelongsTo
     */
    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul');
    }

    /**
     * @return BelongsTo
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
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
                $query->whereHas('dosen', function ($query) use ($search) {
                    $query->where('nama_dosen','like', "%$search%");
                })->orWhereHas('matkul', function ($query) use ($search) {
                    $query->where('nama_matkul', 'like', "%$search%");
                })->orWhereHas('prodi', function ($query) use ($search) {
                    $query->where('nama_prodi', 'like', "%$search%");
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
