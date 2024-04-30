<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

class ShortURL extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return 'door-access.builder';
    }
}