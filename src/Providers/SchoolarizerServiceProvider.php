<?php

namespace Schoolarize\Schoolarizer\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\Router;

class SchoolarizerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $router = $this->app->make(Router::class);
        if ($this->app->runningInConsole()) {
        }
    }
}
