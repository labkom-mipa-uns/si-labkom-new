<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'alat';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function peminjamanalat(): HasMany
    {
        return $this->hasMany(PeminjamanAlat::class);
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
                $query->where('nama_alat', 'like', "%$search%")
                    ->orWhere('harga_alat', 'like', "%$search%")
                    ->orWhere('stok_alat', 'like', "%$search%");
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
