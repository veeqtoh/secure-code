<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Validators;

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;
use Veeqtoh\DoorAccess\Contracts\CodeValidator;

/**
 * Class RepeatingCharactersValidator
 * This class provides validation against repeated limit.
 *
 * @package Veeqtoh\DoorAccess\Classes\Validators
 */
class RepeatingCharactersValidator implements CodeValidator
{
  use ConfigTrait;

  public function isValid(string $code): bool
  {
      return !preg_match('/(.)\1{' . ($this->getSequenceLengthLimit() - 1) . ',}/', $code);
  }

}