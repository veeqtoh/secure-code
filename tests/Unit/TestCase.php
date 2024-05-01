<?php

namespace Veeqtoh\DoorAccess\Tests\Unit;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Veeqtoh\DoorAccess\Facades\DoorAccess;
use Veeqtoh\DoorAccess\Providers\DoorAccessProvider;

abstract class TestCase extends OrchestraTestCase
{
    use LazilyRefreshDatabase;
    use WithWorkbench;

    /**
     * Load package service provider.
     *
     * @param  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [DoorAccessProvider::class];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'DoorAccess' => DoorAccess::class,
        ];
    }
}