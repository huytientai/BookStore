<?php

namespace App\Providers;

use App\Models\User;
use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('admin', function ($user) {
            return $user->role == User::ADMIN;
        });

        Gate::define('guess', function ($user) {
            return $user->role == User::GUESS;
        });

        Gate::define('staff', function ($user) {
            return $user->role == User::STAFF;
        });

        Gate::define('warehouseman',function($user){
           return $user->role==User::WAREHOUSEMAN ;
        });

        Gate::define('seller',function($user){
            return $user->role==User::SELLER ;
        });
    }
}
