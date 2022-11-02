<?php

namespace App\Orchid\Screens\Joke;

use App\Services\JokeService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class JokeDetailsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(JokeService $jokeService)
    {
        $jokes = $jokeService->getRandomTen();
        // dd($jokes->data());
//        foreach ($jokes as $joke){
//            $details = $joke;
//        }
        return
            [
               // 'data' => $details->data()
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
        return 'Joke Details Screen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Back')->route('platform.jokes')->icon('arrow-left-circle')
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
                        foreach ($joke as $item) {
                            $details = $item['id'];
                        }
                        return e($details);
                    }),
                Sight::make('type')
                    ->render(function ($joke) {
                        foreach ($joke as $item) {
                            $details = $item['type'];
                        Link::make($details)
                            ->route('platform.jokes.show', $item['id'])->icon('eye');
                        }
                        return e($details);
                    }),
                Sight::make('setup')
                    ->render(function ($joke) {
                        foreach ($joke as $item) {
                            $details = $item['setup'];
                        }
                        return e($details);
                    }),
                Sight::make('punchline')
                    ->render(function ($joke) {
                        foreach ($joke as $item) {
                            $details = $item['punchline'];
                        }
                        return e($details);
                    }),
            ]),
        ];
    }
}
