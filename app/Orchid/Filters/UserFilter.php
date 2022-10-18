<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Per page';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['per_page'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        // $per_page = Arr::get(request()->all(), 'per_page') ?? 3;
        return $builder;
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        //per_page here
        return [
            Select::make('per_page')
                ->empty('Select per page')
                ->options([
                    '1' => 1,
                    '2' => 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5,
                    '6' => 6])
                ->title(__('Per page')),
            Select::make('page')
                ->empty('Select page')
                ->options([
                    '1' => 1,
                    '2' => 2,
                    '3'=> 3,
                    '4'=> 4,
                    '5'=> 5,
                    '6' => 6])
                ->title(__('Page')),
        ];
    }
}
