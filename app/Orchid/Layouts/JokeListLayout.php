<?php

namespace App\Orchid\Layouts;

use App\Models\Product;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class JokeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'data';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('type', __('Type'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('setup', __('Setup'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->sort(),

            TD::make('punchline', __('Punchline'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

        ];
    }
}
