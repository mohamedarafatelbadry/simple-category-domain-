<?php

namespace Domains\Category\Providers;


use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public const MODULE_NAME = 'Category';

    public function boot(): void
    {
        $this->loadMigrationsFrom([
            dirname(__DIR__) . '/database/migrations'
        ]);
    }

    public function register():void
    {
        $this->app->register(RouteServiceProvider::class);
    }

}
