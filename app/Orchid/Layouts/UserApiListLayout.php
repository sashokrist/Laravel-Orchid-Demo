<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserApiListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'data2';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', __('Id'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($user) {
                    return e($user['id']);
                }),
            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($user) {
                    return e($user['email']);
//                    return  Link::make(e($joke['type']))
//                        ->route('platform.jokes.show', $joke['id'])->icon('eye');
                }),
            TD::make('first_name', __('First_name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($user) {
                    return e($user['first_name']);
                }),
            TD::make('last_name', __('Last_name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($user) {
                    return e($user['last_name']);
                }),


        ];
    }
}
