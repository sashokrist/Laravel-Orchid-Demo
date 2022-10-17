<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\UserApiListLayout;
use App\Services\UserApiService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class UserApiListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(UserApiService $userApiService): iterable
    {
        $users = $userApiService->getAll();
        //dd($users);
        return [
            'data' => $users->data(),
            'data2' => $users->paginate()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'UserApi List Screen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Test post')
                ->icon('note')
                ->route('platform.usersApi.posts'),
               // ->canSee(!$this->post->exists),
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
            UserApiListLayout::class,
        ];
    }
}
