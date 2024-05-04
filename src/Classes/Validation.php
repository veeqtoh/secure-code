<?php

declare(strict_types=1);

namespace Veeqtoh\SecureCode\Classes;

use AshAllenDesign\ConfigValidator\Exceptions\InvalidConfigValueException;
use AshAllenDesign\ConfigValidator\Services\ConfigValidator;
use AshAllenDesign\ConfigValidator\Services\Rule;
use Veeqtoh\SecureCode\Exceptions\ValidationException;

/**
 * Class Validation
 * This class is used for validating the config values.
 *
 * @package Veeqtoh\SecureCode\Classes
 */
class Validation
{
    /**
     * Validate all the config related to the library.
     *
     * @throws ValidationException
     * @throws InvalidConfigValueException
     */
    public function validateConfig(): bool
    {
        $validator = app(ConfigValidator::class);

        $passes = $validator
            ->throwExceptionOnFailure(false)
            ->runInline([
                'secure-code' => [
                    Rule::make('code_length')->rules(['required', 'integer', 'min:1', 'max:19']),
                    Rule::make('character_repeated_limit')->rules(['required', 'integer', 'min:3', 'max:19']),
                    Rule::make('sequence_length_limit')->rules(['required', 'integer', 'min:3']),
                    Rule::make('unique_characters_limit')->rules(['required', 'integer', 'min:3']),
                ],
            ]);

        if (! $passes) {
            $validationMessage = $validator->errors()[array_key_first($validator->errors())][0];

            throw new ValidationException($validationMessage);
        }

        return $passes;
    }
}