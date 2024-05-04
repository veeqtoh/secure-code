<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Contracts;

/**
 * Interface CodeValidator
 * This interface provides the basis of all validation classes behaviors.
 *
 * @package Veeqtoh\SecureCode\Contracts
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