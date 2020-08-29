<?php

namespace App;

use App\Events\EventJasaPrintSaved;
use App\Events\EventJasaPrintUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JasaPrint extends Model
{
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
}
