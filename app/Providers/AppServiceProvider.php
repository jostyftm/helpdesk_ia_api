<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Scramble;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Scramble::ignoreDefaultRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::registerApi('v2', ['info' => ['title' => 'API v2']])
        ->expose(
            ui: '/api/v2/docs',
            document: '/docs/v2/openapi.json',
        );
    }
}
