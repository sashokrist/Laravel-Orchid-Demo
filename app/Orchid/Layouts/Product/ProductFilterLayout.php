<?php

namespace App\Orchid\Layouts\Product;

use App\Orchid\Filters\CategoryFilter;
use App\Orchid\Filters\TagFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class ProductFilterLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): iterable
    {
        return [
            CategoryFilter::class,
            TagFilter::class
        ];
    }
}
