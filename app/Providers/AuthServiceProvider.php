<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('isSuperAdmin', function ($user) {
            return $user->role === 'super admin';
        });

        Gate::define('update-data', function ($user) {
            return $user->role === 'super admin' ? Response::allow() : Response::deny("Maaf, Kamu Bukanlah Super Administrator!");
        });

        Gate::define('delete-data', function ($user) {
            return $user->role === 'super admin' ? Response::allow() : Response::deny("Maaf, Kamu Bukanlah Super Administrator!");
        });
    }
}
