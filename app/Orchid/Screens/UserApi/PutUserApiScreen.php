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

class PutUserApiScreen extends Screen
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
        return 'Test Put Screen';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Test Put method";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Update')
                ->icon('note')
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
                    ->title('Name')
                    ->placeholder('name'),

                Input::make('job')
                    ->title('Job')
                    ->placeholder('job'),

            ])
        ];
    }

    /**
     * @param UserApiService    $userApiService
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(UserApiService $userApiService, Request $request, $id)
    {
        $userApiService->put($request, $id);

        Alert::info('You have successfully tested put request.');

        return redirect()->route('platform.usersApi');
    }
}
