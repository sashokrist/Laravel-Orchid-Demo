<?php

namespace App\Orchid\Screens;

use App\Models\Joke;
use App\Orchid\Layouts\JokeListLayout;
use App\Services\JokeService;
use Illuminate\Http\Response;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class JokeListScreen extends Screen
{

    public function query(){
        return [

         ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Joke Screen';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All jokes. Total: (' . Joke::all()->count() . ')';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
         JokeListLayout::class
        ];
    }
}
