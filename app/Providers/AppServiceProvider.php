<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use app\Models\User;
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
        Gate::define('test', function (User $user) {
            if ($user->id === 1) {
                return true;
            }
            return false;
        });
    }

    public const HOME = '/post';
}
