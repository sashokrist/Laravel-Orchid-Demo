<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\JokeDetailsScreen;
use App\Orchid\Screens\JokeListScreen;
use App\Orchid\Screens\JokeRandomScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\ProductEditScreen;
use App\Orchid\Screens\ProductListScreen;
use App\Orchid\Screens\ProductShowScreen;
use App\Orchid\Screens\RandomJokeScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\UserApi\PostUserApiScreen;
use App\Orchid\Screens\UserApi\PutUserApiScreen;
use App\Orchid\Screens\UserApi\UserApiListScreen;
use App\Orchid\Screens\UserApi\UserApiSingleScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
///Route::screen(ExampleFieldsAdvancedScreen::class, 'example-advanced')->name('platform.example.advanced');

//Product
Route::screen('products/{product}/edit', ProductEditScreen::class)
    ->name('platform.products.edit')
    ->breadcrumbs(function (Trail $trail, $product) {
        return $trail
            ->parent('platform.products')
            ->push(__('Product'), route('platform.products.edit', $product));
    });

Route::screen('products/{product}/show', ProductShowScreen::class)
    ->name('platform.products.show')
    ->breadcrumbs(function (Trail $trail, $product) {
        return $trail
            ->parent('platform.products')
            ->push(__('Product'), route('platform.products.show', $product));
    });

Route::screen('products/create', ProductEditScreen::class)
    ->name('platform.products.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.products')
            ->push(__('Create'), route('platform.products.create'));
    });

Route::screen('products', ProductListScreen::class)
    ->name('platform.products')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Products'), route('platform.products'));
    });

Route::screen('jokes', JokeListScreen::class)
    ->name('platform.jokes')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Jokes'), route('platform.jokes'));
    });

Route::screen('jokes/random', RandomJokeScreen::class)
    ->name('platform.jokes.random')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Jokes'), route('platform.jokes.random'));
    });

Route::screen('jokes/{jokes}/show', JokeDetailsScreen::class)
    ->name('platform.jokes.show')
    ->breadcrumbs(function (Trail $trail, $joke) {
        return $trail
            ->parent('platform.jokes')
            ->push(__('Jokes'), route('platform.jokes.show', $joke));
    });

Route::screen('usersApi', UserApiListScreen::class)
    ->name('platform.usersApi')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('UsersApi'), route('platform.usersApi'));
    });

Route::screen('usersApi/show/{id}', UserApiSingleScreen::class)
    ->name('platform.usersApi.show')
    ->breadcrumbs(function (Trail $trail, $id) {
        return $trail
            ->parent('platform.usersApi')
            ->push(__('userApi'), route('platform.usersApi.show', $id));
    });

Route::screen('usersApi/edit/{id}', PutUserApiScreen::class)
    ->name('platform.usersApi.edit')
    ->breadcrumbs(function (Trail $trail, $id) {
        return $trail
            ->parent('platform.usersApi')
            ->push(__('userApi'), route('platform.usersApi.edit', $id));
    });

Route::screen('usersApi/posts', PostUserApiScreen::class)
    ->name('platform.usersApi.posts')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.usersApi')
            ->push(__('Create'), route('platform.usersApi.posts'));
    });

Route::get('notification/{notifiable}', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notification');
