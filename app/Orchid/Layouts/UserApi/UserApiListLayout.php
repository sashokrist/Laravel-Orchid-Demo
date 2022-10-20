<?php

namespace App\Orchid\Layouts\UserApi;

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
    protected $target = 'data';

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
                    return  Link::make(e($user['email']))
                        ->route('platform.usersApi.show', $user['id'])->icon('eye');
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
            TD::make('avatar', __('avatar'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($user) {
                    return '<img src="https://www.gravatar.com/avatar/1608f765af2ca1155df3ab98346366a9?d=mp" class="bg-light">';
                }),
            TD::make(__('Actions'))
                ->render(function ($user) {
                    return  Link::make('Edit')
                        ->route('platform.usersApi.edit', $user['id'])->icon('pencil');
                }),


        ];
    }
}
//<img src="https://www.gravatar.com/avatar/1608f765af2ca1155df3ab98346366a9?d=mp" class="bg-light">
