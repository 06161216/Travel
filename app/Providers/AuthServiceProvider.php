<?php

namespace App\Providers;

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
    public function boot()
    {
        $this->registerPolicies();

        // 「体験者」だけに適用
        Gate::define('traveler', function ($user) {
            return ($user->permission_id == 1);
        });

        // 「提供者」に適用
        Gate::define('supplier', function ($user) {
            return ($user->permission_id == 2);
        });
    }
}
