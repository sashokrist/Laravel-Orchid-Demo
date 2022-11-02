<?php

namespace App\Orchid\Screens\Joke;

use App\Orchid\Layouts\Joke\JokeListLayout;
use App\Orchid\Layouts\RandomJokeLayout;
use App\Services\JokeService;
use Orchid\Screen\Screen;

class JokeListScreen extends Screen
{

    public function query(JokeService $jokeService)
    {
        $jokes = $jokeService->getRandomTen();

        return [
            'data1' => $jokes->repository(),
            'data2' => $jokes->data(),
            'data3' => $jokes->paginate(),
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
