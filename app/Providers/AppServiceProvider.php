<?php

namespace App\Providers;

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
        // Memberikan akses publik untuk dokumentasi Scramble di /docs/api (termasuk live cloud deployment)
        Gate::define('viewApiDocs', function ($user = null) {
            return true;
        });
    }
}
