<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;

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

    /**
     * @param $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nama_mahasiswa', 'like', '%'.$search.'%')
                    ->orWhere('nim', 'like', '%'.$search.'%')
                    ->orWhere('jenis_kelamin', 'like', '%'.$search.'%')
                    ->orWhere('kelas', 'like', '%'.$search.'%')
                    ->orWhere('angkatan', 'like', '%'.$search.'%')
                    ->orWhere('no_hp', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhereHas('prodi', function ($query) use ($search) {
                        $query->where('nama_prodi', 'like', '%'.$search.'%');
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
