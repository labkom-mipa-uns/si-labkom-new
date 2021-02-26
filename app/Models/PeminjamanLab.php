<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanLab extends Model
{
    use SoftDeletes;

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
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('tanggal', 'like', "%$search%")
                    ->orWhere('jam_pinjam', 'like', "%$search%")
                    ->orWhere('jam_kembali', 'like', "%$search%")
                    ->orWhere('keperluan', 'like', "%$search%")
                    ->orWhere('kategori', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('mahasiswa', function ($query) use ($search) {
                        $query->where('nama_mahasiswa','like', "%$search%");
                    })->orWhereHas('lab', function ($query) use ($search) {
                        $query->where('nama_lab', 'like', "%$search%");
                    })->orWhereHas('jadwal', function ($query) use ($search) {
                        $query->whereHas('dosen', function ($query) use ($search) {
                            $query->where('nama_dosen', 'like', "%$search%");
                        })->orWhereHas('matakuliah', function ($query) use ($search) {
                            $query->where('nama_matkul', 'like', "%$search%");
                        })->orWhereHas('prodi', function ($query) use ($search) {
                            $query->where('nama_prodi', 'like', "%$search%");
                        });
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
