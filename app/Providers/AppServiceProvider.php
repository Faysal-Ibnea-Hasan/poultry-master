<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\HomeInterface;
use App\Interfaces\ManagementInterface;
use App\Interfaces\MenuInterface;
use App\Repositories\AuthRepository;
use App\Repositories\HomeRepository;
use App\Repositories\ManagementRepository;
use App\Repositories\MenuRepository;
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
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(ManagementInterface::class, ManagementRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
