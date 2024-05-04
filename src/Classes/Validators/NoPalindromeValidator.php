<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes\Validators;

use Veeqtoh\SecureCode\Contracts\CodeValidator;

/**
 * Class NoPalindromeValidator
 * This class provides validation against palindrome.
 *
 * @package Veeqtoh\SecureCode\Classes\Validators
 */
class NoPalindromeValidator implements CodeValidator
{
    public function isValid(string $code): bool
    {
      return $code !== strrev($code);
    }
}