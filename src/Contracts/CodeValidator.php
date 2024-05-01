<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Contracts;

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;

/**
 * Interface CodeValidator
 * @package Veeqtoh\DoorAccess\Contracts
 */
interface CodeValidator
{
    use ConfigTrait;
    /**
     * Check that a generated code is valid.
     *
     * @param string $code The generated code.
     *
     * @return boolean True if valid, false if invalid.
     */
    public function isValid(string $code): bool;
}