<?php

namespace App\Providers;

use App\Enum\RoleEnum;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        RoleEnum::class => RolePolicy::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-or-landlord', [RolePolicy::class, 'adminOrLandlord']);
        Gate::define('except-visitor', [RolePolicy::class, 'exceptVisitor']);

        $roles = RoleEnum::options();

        foreach ($roles as $role) {
            Gate::define($role['value'], function($user) use ($role) {
                return $user->role === $role['value'];
            });
        }
    }
}
