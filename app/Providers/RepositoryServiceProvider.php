<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Role\RoleRepositoryInterface', 'App\Repositories\Role\RoleRepository');
        $this->app->bind('App\Repositories\Permission\PermissionRepositoryInterface', 'App\Repositories\Permission\PermissionRepository');
        $this->app->bind('App\Repositories\User\UserRepositoryInterface', 'App\Repositories\User\UserRepository');
        $this->app->bind('App\Repositories\Project\ProjectRepositoryInterface', 'App\Repositories\Project\ProjectRepository');
        $this->app->bind('App\Repositories\ProjectUser\ProjectUserRepositoryInterface', 'App\Repositories\ProjectUser\ProjectUserRepository');
        $this->app->bind('App\Repositories\WO\WORepositoryInterface', 'App\Repositories\WO\WORepository');
    }
}
