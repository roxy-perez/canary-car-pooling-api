<?php

namespace App\Providers;

use App\Interfaces\CarRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MunicipioRepository;
use App\Repositories\ProvinciaRepository;
use App\Interfaces\MunicipioRepositoryInterface;
use App\Interfaces\ProvinciaRepositoryInterface;
use App\Repositories\CarRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProvinciaRepositoryInterface::class,
            ProvinciaRepository::class,
        );

        $this->app->bind(
            MunicipioRepositoryInterface::class,
            MunicipioRepository::class
        );

        $this->app->bind(
            CarRepositoryInterface::class,
            CarRepository::class
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
