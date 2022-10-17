<?php

namespace App\Orchid\Screens;

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
    public function query(UserApiService $userApiService): iterable
    {
        $users = $userApiService->getAll();
        //dd($users);
        return [
            'data' => $users->data(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'PostUserApiScreen';
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
                Input::make('post.name')
                    ->title('Title')
                    ->placeholder('name'),

                Input::make('post.email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('email'),

                Input::make('post.password')
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
       // dd($request->all());
        //  $post->fill($request->get('post'))->save();
        $userApiService->postUser($request);

        Alert::info('You have successfully created a user.');

        return redirect()->route('platform.usersApi');
    }
}
