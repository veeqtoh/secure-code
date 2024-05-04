<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * class SecureCode
 * This class provides the facade for this library.
 *
 * @package Veeqtoh\SecureCode\Facades
 */
class SecureCode extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return 'secure-code.code-generator';
    }
}