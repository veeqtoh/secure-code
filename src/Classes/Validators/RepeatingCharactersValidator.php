<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Validators;

use Veeqtoh\DoorAccess\Contracts\CodeValidator;

/**
 * Class RepeatingCharactersValidator
 * The library class that is used for validating against repeated limit.
 *
 * @package Veeqtoh\DoorAccess\Classes\Validators
 */
class RepeatingCharactersValidator implements CodeValidator
{
  public function isValid(string $code): bool
  {
    return !preg_match('/(.)\1{' . (config('sequence_length_limit') ?? '3' - 1) . ',}/', $code);
  }
}