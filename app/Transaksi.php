<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function peminjamanalat(): BelongsTo
    {
        return $this->belongsTo(PeminjamanAlat::class, 'id_peminjaman_alat')->with(['alat']);
    }

    /**
     * @return BelongsTo
     */
    public function jasainstallasi(): BelongsTo
    {
        return $this->belongsTo(JasaInstallasi::class, 'id_jasa_installasi');
    }

    /**
     * @return BelongsTo
     */
    public function jasaprint(): BelongsTo
    {
        return $this->belongsTo(JasaPrint::class, 'id_jasa_print');
    }
}
