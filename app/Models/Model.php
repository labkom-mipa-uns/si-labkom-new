<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class Model extends Eloquent
{
    protected $guarded = [];

    protected $perPage = 10;

    /**
     * @param mixed $value
     * @param null $field
     * @return Eloquent|null
     */
    public function resolveRouteBinding($value, $field = null): ?Eloquent
    {
        return in_array(SoftDeletes::class, class_uses($this), true)
            ? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
            : parent::resolveRouteBinding($value);
    }
}
