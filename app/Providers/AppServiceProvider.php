<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\HomeInterface;
use App\Repositories\AuthRepository;
use App\Repositories\HomeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(HomeInterface::class, HomeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
