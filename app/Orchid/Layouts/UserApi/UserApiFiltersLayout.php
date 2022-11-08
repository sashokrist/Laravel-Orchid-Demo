<?php

namespace App\Orchid\Layouts\UserApi;

use App\Orchid\Filters\UserFilter;
use App\Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class UserApiFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
           UserFilter::class,
        ];
    }
}
