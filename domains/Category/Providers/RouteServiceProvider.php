<?php

namespace Domains\Category\Providers;

use Domains\Base\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

 class RouteServiceProvider extends ServiceProvider
{
    public function map(Router $router): void
    {
        $namespace = 'Domains\Category\Http\Controllers';
        $routes = __DIR__.'/../Http/api.php';
        $prefix = 'categories';

        $this->loadRoutesFiles($router, $namespace, $routes, $prefix);
    }


}

