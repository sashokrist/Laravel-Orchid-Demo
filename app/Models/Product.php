<?php

namespace App\Models;

use App\Orchid\Presenters\ProductPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource, Filterable, Attachable, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
    ];


    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'title',
        'price',
        'tags.name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'title',
        'price',
        'tags.name',
        'updated_at',
        'created_at',
    ];



    /**
     * Get the presenter for the model.
     *
     * @return ProductPresenter
     */
    public function presenter()
    {
        return new ProductPresenter($this);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    /**
     * @param Builder $query
     */
    public function scopeOrderByTagName(Builder $query, $direction)
    {
        $query->leftJoin('tags','tags.id','=','products.tag_id')
            ->orderBy('tags.name', 'asc');
    }

}
