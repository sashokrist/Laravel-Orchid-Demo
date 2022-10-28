<?php

namespace App\Orchid\Presenters;

use Illuminate\Support\Str;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class ProductPresenter extends Presenter implements Searchable
{
    /**
     * @return string
     */
    public function label(): string
    {
        return 'Products';
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->entity->title;
    }

    /**
     * @return string
     */
    public function image(): ?string
    {
        return $this->entity->image;
    }

    /**
     * The number of models to return for show compact search result.
     *
     * @return int
     */
    public function perSearchShow(): int
    {
        return 3;
    }

    /**
     * @param string|null $query
     *
     * @return Builder
     */
    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
        //return $this->entity->search($query)->where('title', true);
    }

    public function subTitle(): string
    {
        return $this->entity->description;
    }

    public function url(): string
    {
        return route('platform.products.show', $this->entity->id);
    }
}
