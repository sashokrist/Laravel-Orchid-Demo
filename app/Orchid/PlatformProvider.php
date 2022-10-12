<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make(__('Products'))
                ->icon('present')
                ->route('platform.products')
                ->title(__('Product')),
              //  ->permission('platform.systems.roles'),

            Menu::make(__('Jokes'))
                ->icon('quote')
                ->route('platform.jokes')
                ->title(__('Jokes')),

            Menu::make(__('JokesRandom'))
                ->icon('quote')
                ->route('platform.jokes.random'),

            Menu::make(__('UsersApi'))
                ->icon('user')
                ->route('platform.usersApi')
                ->title(__('UserApi')),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
            ItemPermission::group(__('Products'))
                ->addPermission('platform.products.list', __('List'))
                ->addPermission('platform.products.create', __('create'))
                ->addPermission('platform.product.update', __('Update'))
                ->addPermission('platform.product.delete', __('Delete')),
            ItemPermission::group(__('Jokes'))
                ->addPermission('platform.jokes.list', __('List')),
            ItemPermission::group(__('UserApi'))
                ->addPermission('platform.userApi.list', __('List')),
        ];
    }
}
