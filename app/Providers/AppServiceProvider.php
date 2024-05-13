<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(true);

        Gate::define('administrate', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('perform', function ($user) {
            return $user->hasRole('artist');
        });

        // Gate::define('volunteer', function ($user) {
        //     return $user->hasRole('volunteer');
        // });
    }
}
