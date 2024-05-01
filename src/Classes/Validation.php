<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes;

use AshAllenDesign\ConfigValidator\Exceptions\InvalidConfigValueException;
use AshAllenDesign\ConfigValidator\Services\ConfigValidator;
use AshAllenDesign\ConfigValidator\Services\Rule;
use Veeqtoh\DoorAccess\Exceptions\ValidationException;

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
                'door-access' => [
                    Rule::make('code_length')->rules(['required', 'integer', 'min:6', 'max:19']),
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