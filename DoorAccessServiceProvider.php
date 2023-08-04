<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess;

use Illuminate\Support\ServiceProvider;

class DoorAccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the package configuration file to the Laravel application
        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('door-access.php'),
        ], 'config');

        // Migrate the package's database tables
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the package configuration with the Laravel application's configuration
        $this->mergeConfigFrom(__DIR__ . '/Config/config.php', 'door-access');

        // Bind the database implementation to the container
        $this->app->bind(Database\DatabaseInterface::class, Database\SQLiteDatabase::class);

        // Bind the code generator and code manager into the container
        $this->app->singleton(CodeGenerator::class, function ($app) {
            return new CodeGenerator(config('door-access.rules'));
        });

        $this->app->singleton(CodeManager::class, function ($app) {
            return new CodeManager($app->make(Database\DatabaseInterface::class));
        });
    }
}
