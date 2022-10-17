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

class PutUserApiScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(UserApiService $userApiService): iterable
    {
        $users = $userApiService->getAll();
       // dd($users);
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
        return 'Put UserApi Screen';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "userApi";
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
                Input::make('post.name')
                    ->title('Name')
                    ->placeholder('name'),

                Input::make('post.job')
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
       // dd($request->all());
      //  $post->fill($request->get('post'))->save();
        $userApiService->putUser($request, $id);

        Alert::info('You have successfully updated a user.');

        return redirect()->route('platform.usersApi');
    }
}
