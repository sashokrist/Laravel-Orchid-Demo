<?php

namespace App\Orchid\Screens\UserApi;

use App\Services\UserApiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PostUserApiScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Test Post Screen';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Test Post method";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Test Post')
                ->icon('pencil')
                ->method('createOrUpdate'),
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
            Layout::rows([
                Input::make('name')
                    ->title('Title')
                    ->placeholder('name'),

                Input::make('email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('email'),

                Input::make('password')
                    ->type('password')
                    ->title('Password')
                    ->placeholder('password'),

            ])
        ];
    }

    /**
     * @param UserApiService    $userApiService
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(UserApiService $userApiService, Request $request)
    {
        $userApiService->post($request);

        Alert::info('You have successfully post a user.');

        return redirect()->route('platform.usersApi');
    }
}
