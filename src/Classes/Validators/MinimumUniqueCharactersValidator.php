<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Validators;

use Veeqtoh\DoorAccess\Contracts\CodeValidator;

/**
 * Class MinimumUniqueCharactersValidator
 * The library class that is used for validating against minimum unique characters.
 *
 * @package Veeqtoh\DoorAccess\Classes\Validators
 */
class MinimumUniqueCharactersValidator implements CodeValidator
{
  public function isValid(string $code): bool
  {
    $allowedCharactersCount = count_chars(config('allowed_characters') ?? '0123456789', 1);
    $codeCharactersCount    = count_chars($code, 1);

    $uniqueCharactersCount = 0;

    foreach ($codeCharactersCount as $character => $count) {
      if (isset($allowedCharactersCount[$character])) {
        $uniqueCharactersCount++;
      }
    }

    return $uniqueCharactersCount >= config('character_repeated_limit') ?? 3;
  }
}