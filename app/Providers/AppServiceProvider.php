<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('admin', function() {
            return auth()->check() && auth()->user()->role == "admin";
        });

        Gate::define('petugas', function() {
            return auth()->check() && auth()->user()->role == "petugas";
        });

        Gate::define('peminjam', function() {
            return auth()->check() && auth()->user()->role == "peminjam";
        });
    }
}
