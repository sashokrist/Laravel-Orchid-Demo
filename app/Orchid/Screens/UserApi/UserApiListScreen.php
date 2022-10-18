<?php

namespace App\Orchid\Screens\UserApi;

use App\Orchid\Layouts\UserApi\UserApiFiltersLayout;
use App\Orchid\Layouts\UserApi\UserApiListLayout;
use App\Services\UserApiService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use function Termwind\render;

class UserApiListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(UserApiService $userApiService): iterable
    {
        $users = $userApiService->get($this->getParameters()); //filters with all params
        return [
            'data' => $users->paginate()
        ];
    }

    private function getParameters(){
        return  request()->all();
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
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Get all users";
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
            UserApiFiltersLayout::class,
            UserApiListLayout::class,
        ];
    }
}
