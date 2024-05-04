<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes\Traits;

/**
 * Trait ConfigTrait
 * This trait provides methods to retrieve configuration settings for the SecureCode package.
 *
 * @package Veeqtoh\SecureCode\Classes\Traits
 */
trait ConfigTrait
{
    /**
     * Retrieve the allowed characters for the set code format in the configuration.
     *
     * @return string The allowed characters.
     */
    public function getAllowedCharacters(): string
    {
        $format = config('secure-code.code_format');

        switch ($format) {
            case 'numeric':
                return config('secure-code.numeric_characters') ?? '0123456789';
            case 'mixed':
                return config('secure-code.mixed_characters') ?? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{};:<>,.?/';
            default:
                return config('secure-code.alphanumeric_characters') ?? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
    }

    /**
     * Retrieve the code length from the configuration.
     *
     * @return int The code length.
     */
    public function getCodeLength(): int
    {
        if(
            config('secure-code.code_length')
            && config('secure-code.code_length') > 19
        ){
            return 19;
        } else {
            return config('secure-code.code_length') ?? 6;
        }
    }

    /**
     * Retrieve the character repeated limit from the configuration.
     *
     * @return int The character repeated limit.
     */
    public function getCharacterRepeatedLimit(): int
    {
        if(
            config('secure-code.character_repeated_limit')
            && config('secure-code.character_repeated_limit') > $this->getCodeLength()
        ){
            return $this->getCodeLength();
        } else {
            return config('secure-code.character_repeated_limit') ?? 3;
        }
    }

    /**
     * Retrieve the sequence length limit from the configuration.
     *
     * @return int The sequence length limit.
     */
    public function getSequenceLengthLimit(): int
    {
        return config('secure-code.sequence_length_limit') ?? 3;
    }

    /**
     * Retrieve the unique characters limit from the configuration.
     *
     * @return int The unique characters limit.
     */
    public function getUniqueCharactersLimit(): int
    {
        return config('secure-code.unique_characters_limit') ?? 6;
    }

    /**
     * Retrieve the code format from the configuration.
     *
     * @return string The code format.
     */
    public function getCodeFormat(): string
    {
        return config('secure-code.code_format') ?? 'numeric';
    }
}

