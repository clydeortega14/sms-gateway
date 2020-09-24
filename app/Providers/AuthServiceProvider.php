<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('isSuperadmin', function($user){

            return auth()->user()->hasRole('superadmin');
        });

        $gate->define('isAdmin', function($user){

            return auth()->user()->hasRole('admin');
        });

        $gate->define('isHeadOffice', function($user){

            return auth()->user()->hasRole('head_office');
        });

        $gate->define('isBranch', function($user){

            return auth()->user()->hasRole('branch');
        });

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(5));

        Passport::enableImplicitGrant();
    }
}
