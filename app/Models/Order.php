<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Order extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'details',
        'client',
        'product_id'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'details',
        'client',
        'product_id'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'details',
        'client',
        'product_id'
    ];

    /**
     * Get the user's first name.
     *
     * @return Attribute
     */
    protected function data(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => json_decode($value, true, 512, JSON_THROW_ON_ERROR),
            set: static fn ($value) => json_encode($value, JSON_THROW_ON_ERROR),
        );
    }
}
