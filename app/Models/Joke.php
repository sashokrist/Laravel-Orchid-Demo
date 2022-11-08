<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use App\Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Joke extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
      'type',
      'setup',
      'punchline'
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'type',
        'setup',
        'punchline'
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'type',
        'setup',
        'punchline',
        'updated_at',
        'created_at',
    ];
}
