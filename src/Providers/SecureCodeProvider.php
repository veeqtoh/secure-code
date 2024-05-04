<?php
declare(strict_types=1);

namespace Veeqtoh\SecureCode\Providers;

use Illuminate\Support\ServiceProvider;
use Veeqtoh\SecureCode\Classes\Validation;

/**
 * class SecureCodeProvider
 * This class registers the package within Laravel.
 *
 * @package Veeqtoh\SecureCode\Providers
 */
class SecureCodeProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the Laravel application's configuration.
        $this->mergeConfigFrom(__DIR__ . '/../../config/secure-code.php', 'secure-code');

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
            __DIR__ . '/../../config/secure-code.php' => config_path('secure-code.php'),
        ], 'config');

        // Publish the package's migrations.
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'secure-code-migrations');

        // Validate the library configs or not.
        if (config('secure-code') && config('secure-code.validate_config')) {
            (new Validation())->validateConfig();
        }
    }
}
