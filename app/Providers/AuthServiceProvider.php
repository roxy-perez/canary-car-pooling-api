<?php

namespace App\Providers;

use App\Models\UserCar;
use App\Policies\RolePolicy;
use App\Policies\UserCarPolicy;
use App\Policies\EntityPolicy;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Car;
use App\Models\Municipio;
use App\Models\Provincia;

class AuthServiceProvider extends ServiceProvider
{
  protected $policies = [
    Car::class => EntityPolicy::class,
    Municipio::class => EntityPolicy::class,
    Provincia::class => EntityPolicy::class,
    UserCar::class => UserCarPolicy::class,
    Role::class => RolePolicy::class,
  ];

  public function boot()
  {
    $this->registerPolicies();
  }
}
