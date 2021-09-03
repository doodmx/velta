<?php

namespace App\Providers;

use App\Interfaces\User\RoleInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Interfaces\User\PermissionInterface;
use App\Repositories\User\PermissionRepository;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
    }
}
