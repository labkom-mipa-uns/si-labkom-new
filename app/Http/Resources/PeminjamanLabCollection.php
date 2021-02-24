<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\HigherOrderCollectionProxy;

class PeminjamanLabCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return HigherOrderCollectionProxy
     */
    public function toArray($request): HigherOrderCollectionProxy
    {
        return $this->collection->map->only(
            ['id', 'mahasiswa', 'lab', 'dosen', 'matakuliah', 'tanggal', 'jam_pinjam',
            'jam_kembali', 'keperluan', 'kategori', 'status', 'proses', 'deleted_at']
        );
    }
}
