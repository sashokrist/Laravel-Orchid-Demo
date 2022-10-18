<?php

namespace App\Orchid\Screens\UserApi;

use App\Services\UserApiService;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class UserApiSingleScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(UserApiService $userApiService, $id): iterable
    {
        $users = $userApiService->getById($id);
        return [
            'data' => $users->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'UserApiSingleScreen';
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
            Layout::legend('data', [
                Sight::make('id')
                    ->render(function ($user) {
                        return e($user['id']);
                    }),
                Sight::make('email')
                    ->render(function ($user) {
                        return e($user['email']);
                    }),
                Sight::make('first_name')
                    ->render(function ($user) {
                        return e($user['first_name']);
                    }),
                Sight::make('last_name')
                    ->render(function ($user) {
                        return e($user['last_name']);
                    }),
            ]),
        ];
    }
}
