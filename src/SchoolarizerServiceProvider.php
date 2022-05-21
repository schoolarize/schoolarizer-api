<?php

namespace Schoolarize\Schoolarizer;

use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\Router;

/**
 * Middleware
 */
use Schoolarize\Schoolarizer\Http\Middleware\Permission\Permission;
use Schoolarize\Schoolarizer\Http\Middleware\Permission\PermissionViaRole;
use Schoolarize\Schoolarizer\Http\Middleware\Permission\PermissionOrRole;

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

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        
        $router = $this->app->make(Router::class);


        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('permissionViaRole', PermissionViaRole::class);
        $router->aliasMiddleware('permissionOrRole', PermissionOrRole::class);

        
        if ($this->app->runningInConsole()) {

            $this->registerMigrations();
            //Commands
            $this->commands([
                Console\Commands\InstallCommand::class,
                Console\Commands\CreateUserCommand::class,
                Console\Commands\GenerateCommand::class,
                Console\Commands\GenerateActivityLogsCommand::class,
                Console\Commands\GenerateUsersCommand::class,
                Console\Commands\GenerateSessionCommand::class,
            ]);

            // Publish User Model
            $this->publishes([
                __DIR__.'/Models/User.php' => app_path('User.php'),
              ], 'schoolarizer-user-model');

              //Publish on installation
              $this->publishes([
                  __DIR__.'/Models/User.php' => app_path('User.php'),
                  __DIR__.'/../routes/web.php' => base_path('routes/web.php'),
                  __DIR__.'/../resources/lara' => resource_path('views'),
                  __DIR__.'/../config/schoolarizer.php' => config_path('schoolarizer.php')
              ], 'schoolarizer-install');

        }
    }


      /**
     * Register Schoolarizer's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        return $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

}
