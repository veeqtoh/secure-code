<?php
declare(strict_type=1);

namespace Veeqtoh\DoorAccess;

use Illuminate\Support\ServiceProvider;

class DoorAccessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('code.generator', function ($app) {
            return new CodeGenerator();
        });

        $this->app->singleton('code.manager', function ($app) {
            return new CodeManager();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish the configuration file when the package is booted
        $this->publishes([
            __DIR__.'/../config/door-access.php' => config_path('door-access.php'),
        ], 'config');
    }
}