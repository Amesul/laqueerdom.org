<?php

namespace App\Providers;

use App\Models\User;
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
        Model::preventLazyLoading();

        Gate::define('administrate', function (User $user) {
           return $user->hasRole('admin');
        });

        Gate::define('edit', function (User $user) {
            return $user->hasRole('staff');
        });

        Gate::define('perform', function (User $user) {
          return $user->hasRole('artist');
        });

        // Gate::define('volunteer', function ($user) {
        //     return $user->hasRole('volunteer');
        // });
    }
}
