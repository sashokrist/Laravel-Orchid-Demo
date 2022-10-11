<?php

namespace App\Providers;

use App\Models\Joke;
use App\Repositories\JokeRepository;
use App\Services\JokeService;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
