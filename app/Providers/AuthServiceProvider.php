<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Car;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Policies\EntityPolicy;

class AuthServiceProvider extends ServiceProvider
{
  protected $policies = [
    Car::class => EntityPolicy::class,
    Municipio::class => EntityPolicy::class,
    Provincia::class => EntityPolicy::class,
  ];

  public function boot()
  {
    $this->registerPolicies();
  }
}
