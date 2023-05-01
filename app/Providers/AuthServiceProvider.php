<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('ACCESS_ACTIVE', True)) {
            $this->registerPolicies();

            $resources = \App\Models\Resource::all();

            Gate::before(function ($user){
                if($user->owner) return True;
            });

            foreach ($resources as $resource) {
                Gate::define($resource->resource, function ($user) use ($resource){
                    foreach ($user->roles as $role) {
                        if($resource->roles->contains($role))
                        {
                            return True;
                        }
                    }
                    return False;
                });
            }
        }
    }
}