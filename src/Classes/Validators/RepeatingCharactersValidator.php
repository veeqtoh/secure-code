<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes\Validators;

use Veeqtoh\SecureCode\Classes\Traits\ConfigTrait;
use Veeqtoh\SecureCode\Contracts\CodeValidator;

/**
 * Class RepeatingCharactersValidator
 * This class provides validation against repeated limit.
 *
 * @package Veeqtoh\SecureCode\Classes\Validators
 */
class RepeatingCharactersValidator implements CodeValidator
{
  use ConfigTrait;

  public function isValid(string $code): bool
  {
      return !preg_match('/(.)\1{' . ($this->getSequenceLengthLimit() - 1) . ',}/', $code);
  }

}