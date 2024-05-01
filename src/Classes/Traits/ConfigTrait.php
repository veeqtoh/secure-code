<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes\Traits;

/**
 * Trait ConfigTrait
 * This trait provides methods to retrieve configuration settings for the DoorAccess package.
 *
 * @package Veeqtoh\DoorAccess
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
        $format = config('door-access.code_format');

        switch ($format) {
            case 'numeric':
                return config('door-access.numeric_characters') ?? '0123456789';
            case 'mixed':
                return config('door-access.mixed_characters') ?? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{};:<>,.?/';
            default:
                return config('door-access.alphanumeric_characters') ?? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
    }

    /**
     * Retrieve the code length from the configuration.
     *
     * @return int The code length.
     */
    public function getCodeLength(): int
    {
        return config('door-access.code_length') ?? 6;
    }

    /**
     * Retrieve the character repeated limit from the configuration.
     *
     * @return int The character repeated limit.
     */
    public function getCharacterRepeatedLimit(): int
    {
        return config('door-access.character_repeated_limit') ?? 3;
    }

    /**
     * Retrieve the sequence length limit from the configuration.
     *
     * @return int The sequence length limit.
     */
    public function getSequenceLengthLimit(): int
    {
        return config('door-access.sequence_length_limit') ?? 3;
    }

    /**
     * Retrieve the unique characters limit from the configuration.
     *
     * @return int The unique characters limit.
     */
    public function getUniqueCharactersLimit(): int
    {
        return config('door-access.unique_characters_limit') ?? 6;
    }

    /**
     * Retrieve the code format from the configuration.
     *
     * @return string The code format.
     */
    public function getCodeFormat(): string
    {
        return config('door-access.code_format') ?? 'numeric';
    }
}

