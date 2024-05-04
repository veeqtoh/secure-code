<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Providers;

use Illuminate\Support\ServiceProvider;
use Veeqtoh\DoorAccess\Classes\Validation;

/**
 * class DoorAccessProvider
 * This class registers the package within Laravel.
 *
 * @package Veeqtoh\DoorAccess\Providers
 */
class DoorAccessProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the Laravel application's configuration.
        $this->mergeConfigFrom(__DIR__ . '/../../config/door-access.php', 'door-access');

    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish the package configuration file to the Laravel application.
        $this->publishes([
            __DIR__ . '/../../config/door-access.php' => config_path('door-access.php'),
        ], 'config');

        // Publish the package's migrations.
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'door-access-migrations');

        // Validate the library configs or not.
        if (config('door-access') && config('door-access.validate_config')) {
            (new Validation())->validateConfig();
        }
    }
}
