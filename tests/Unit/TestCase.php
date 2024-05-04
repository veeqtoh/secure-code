<?php

namespace Veeqtoh\SecureCode\Tests\Unit;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Veeqtoh\SecureCode\Facades\SecureCode;
use Veeqtoh\SecureCode\Providers\SecureCodeProvider;

abstract class TestCase extends OrchestraTestCase
{
    use LazilyRefreshDatabase;
    use WithWorkbench;

    /**
     * Load package service provider.
     *
     * @param  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [SecureCodeProvider::class];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'SecureCode' => SecureCode::class,
        ];
    }
}