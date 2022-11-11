<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Order extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'details',
        'client'
    ];

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'details',
        'client',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'details',
        'client',
    ];
}
