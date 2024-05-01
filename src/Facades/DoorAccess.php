<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * class DoorAccess
 * This class provides the facade for this library.
 *
 * @package Veeqtoh\DoorAccess\Facades
 */
class DoorAccess extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return 'door-access.code-generator';
    }
}