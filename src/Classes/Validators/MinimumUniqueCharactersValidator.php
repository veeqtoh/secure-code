<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes\Validators;

use Veeqtoh\SecureCode\Classes\Traits\ConfigTrait;
use Veeqtoh\SecureCode\Contracts\CodeValidator;

/**
 * Class MinimumUniqueCharactersValidator
 * This class provides validation against minimum unique characters.
 *
 * @package Veeqtoh\SecureCode\Classes\Validators
 */
class MinimumUniqueCharactersValidator implements CodeValidator
{
    use ConfigTrait;
    
    public function isValid(string $code): bool
    {
        $allowedCharactersCount = count_chars($this->getAllowedCharacters(), 1);
        $codeCharactersCount    = count_chars($code, 1);

        $uniqueCharactersCount = 0;

        foreach ($codeCharactersCount as $character => $count) {
            if (isset($allowedCharactersCount[$character])) {
                $uniqueCharactersCount++;
            }
        }

        return $uniqueCharactersCount >= $this->getCharacterRepeatedLimit();
    }

}