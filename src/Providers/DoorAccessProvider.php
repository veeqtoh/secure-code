<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Providers;

use Illuminate\Support\ServiceProvider;

class DoorAccessProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the Laravel application's configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/door-access.php', 'door-access');

    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the package configuration file to the Laravel application
        $this->publishes([
            __DIR__ . '/../../config/door-access.php' => config_path('door-access.php'),
        ], 'config');

        // Migrate the package's database tables
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'door-access-migrations');
    }
}
