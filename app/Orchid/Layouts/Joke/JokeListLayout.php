<?php

namespace App\Orchid\Layouts\Joke;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class JokeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'data3';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('Id'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($joke) {
                    return e($joke['id']);
                }),
            TD::make('type', __('Type'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($joke) {
                    return  Link::make(e($joke['type']))
                        ->route('platform.jokes.show', $joke['id'])->icon('eye');
                }),
            TD::make('setup', __('Setup'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($joke) {
                    return e($joke['setup']);
                }),
            TD::make('punchline', __('Punchline'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function ($joke) {
                    return e($joke['punchline']);
                }),


        ];
    }
}
