<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CarRepository;
use App\Repositories\MunicipioRepository;
use App\Repositories\ProvinciaRepository;
use App\Repositories\UserRepository;
use App\Interfaces\CarRepositoryInterface;
use App\Interfaces\MunicipioRepositoryInterface;
use App\Interfaces\ProvinciaRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CarRepositoryInterface::class,
            CarRepository::class
        );

        $this->app->bind(
            MunicipioRepositoryInterface::class,
            MunicipioRepository::class
        );

        $this->app->bind(
            ProvinciaRepositoryInterface::class,
            ProvinciaRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
