<?php

namespace App\Orchid\Layouts\Product;

use App\Orchid\Filters\ProductFilter;
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
            ProductFilter::class,
        ];
    }
}
