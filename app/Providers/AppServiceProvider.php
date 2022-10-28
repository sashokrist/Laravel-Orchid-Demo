<?php

namespace App\Providers;

use App\Models\Joke;
use App\Models\Product;
use App\Repositories\JokeRepository;
use App\Services\JokeService;
use App\Services\UserApiService;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JokeService::class, function ($app) {
            return new JokeService();
        });

        $this->app->singleton(UserApiService::class, function ($app) {
            return new UserApiService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerSearch([
            Product::class,
            //...Models
        ]);
    }
}
