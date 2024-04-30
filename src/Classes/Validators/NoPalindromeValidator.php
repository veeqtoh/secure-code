<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Validators;

use Veeqtoh\DoorAccess\Interfaces\CodeValidator;

/**
 * Class NoPalindromeValidator
 * The library class that is used for validating against palindrome.
 *
 * @package Veeqtoh\DoorAccess\Classes\Validators
 */
class NoPalindromeValidator implements CodeValidator
{
    public function isValid(string $code): bool
    {
      return $code !== strrev($code);
    }
}