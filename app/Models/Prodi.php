<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodi extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'prodi';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    /**
     * @return HasMany
     */
    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
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
                $query->where('nama_prodi', 'like', '%'.$search.'%');
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
