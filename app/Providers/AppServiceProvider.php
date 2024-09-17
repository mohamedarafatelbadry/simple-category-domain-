<?php

namespace App\Providers;

use Domains\Category\Providers\CategoryServiceProvider;
use Domains\Slider\Providers\SliderServiceProvider;
use Domains\Test\Providers\TestServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(provider: TestServiceProvider::class);
        $this->app->register(provider: CategoryServiceProvider::class);
        $this->app->register(provider: SliderServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
