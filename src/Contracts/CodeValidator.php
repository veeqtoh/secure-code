<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Contracts;

/**
 * Interface CodeValidator
 * @package Veeqtoh\DoorAccess\Contracts
 */
interface CodeValidator
{
    /**
     * Check that a generated code is valid.
     *
     * @param string $code The generated code.
     *
     * @return boolean True if valid, false if invalid.
     */
    public function isValid(string $code): bool;
}