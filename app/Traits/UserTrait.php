<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait UserTrait
{
    /*
     * @method Builder customers
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomers($query)
    {
        return $query->whereHas('roles', function (Builder $query) {
            $query->where('name',  'customer');
        });
    }
}
