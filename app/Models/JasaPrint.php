<?php

namespace App\Models;
use App\Events\EventJasaPrintSaved;
use App\Events\EventJasaPrintUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JasaPrint extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'jasa_print';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => EventJasaPrintSaved::class,
        'updated' => EventJasaPrintUpdated::class,
    ];

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
                $query->where('jenis_print', 'like', "%$search%")
                    ->orWhere('harga_print', 'like', "%$search%")
                    ->orWhere('jumlah_print', 'like', "%$search%")
                    ->orWhere('tanggal_print', 'like', "%$search%");
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
