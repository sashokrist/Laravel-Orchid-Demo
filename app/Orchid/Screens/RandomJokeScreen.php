<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\RandomJokeLayout;
use App\Services\JokeService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class RandomJokeScreen extends Screen
{

    public function query(JokeService $jokeService)
    {
        $jokes = $jokeService->getRandom();
       // dd($jokes->data());
        return [
           'data' => $jokes->data()
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
        return '';
        //return 'All jokes. Total: (' . Joke::all()->count() . ')';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Back')->route('platform.products')->icon('arrow-left-circle')
        ];
    }


    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('data', [
                Sight::make('id')
                    ->render(function ($joke) {
                        return e($joke['id']);
                    }),
                Sight::make('type')
                    ->render(function ($joke) {
                        return e($joke['type']);
                    }),
                Sight::make('setup')
                    ->render(function ($joke) {
                        return e($joke['setup']);
                    }),
                Sight::make('punchline')
                    ->render(function ($joke) {
                        return e($joke['punchline']);
                    }),
            ]),
        ];
    }
}
