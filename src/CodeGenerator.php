<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess;

use Config\rules as RulesConfig;

/**
 * Class CodeGenerator
 * @package Veeqtoh\DoorAccess
 */
class CodeGenerator
{
    /**
     * Generate a unique 6-digit code.
     *
     * @return string|null The generated code or null if code generation fails.
     */
    public function generateCode(): ?string
    {
        $rules = $this->getRules();
        do {
            $code = $this->generateRandomCode();
        } while (!$this->isCodeValid($code, $rules));

        return $code;
    }

    /**
     * Generate a random 6-digit code.
     *
     * @return string
     */
    private function generateRandomCode(): string
    {
        return (string) random_int(100000, 999999);
    }

    /**
     * Check if the generated code is valid according to the constraints.
     *
     * @param string $code
     * @param array $rules The rules for generating the code.
     * @return bool
     */
    private function isCodeValid(string $code, array $rules): bool
    {
        $allowedCharacters      = $rules['allowed_characters'] ?? '0123456789';
        $characterRepeatedLimit = $rules['character_repeated_limit'] ?? 3;
        $sequenceLengthLimit    = $rules['sequence_length_limit'] ?? 3;
        $uniqueCharactersLimit  = $rules['unique_characters_limit'] ?? 3;

        return (
            $this->isNotPalindrome($code) &&
            $this->hasNoCharacterRepeatedMoreThanLimit($code, $characterRepeatedLimit) &&
            $this->hasNoSequenceLengthGreaterThanLimit($code, $sequenceLengthLimit) &&
            $this->hasAtLeastLimitUniqueCharacters($code, $uniqueCharactersLimit, $allowedCharacters)
        );
    }

    /**
     * Check if the code is not a palindrome.
     *
     * @param string $code
     * @return bool
     */
    private function isNotPalindrome(string $code): bool
    {
        return $code !== strrev($code);
    }

    /**
     * Check if the code has no character repeated more than the limit.
     *
     * @param string $code
     * @param int $limit
     * @return bool
     */
    private function hasNoCharacterRepeatedMoreThanLimit(string $code, int $limit): bool
    {
        return !preg_match('/(\d)\1{' . ($limit - 1) . ',}/', $code);
    }

    /**
     * Check if the code has no sequence length greater than the limit.
     *
     * @param string $code
     * @param int $limit
     * @return bool
     */
    private function hasNoSequenceLengthGreaterThanLimit(string $code, int $limit): bool
    {
        return !preg_match('/(\d)\1{' . ($limit - 1) . ',}/', $code);
    }

    /**
     * Check if the code has at least the limit number of unique characters from the allowed characters.
     *
     * @param string $code
     * @param int $limit
     * @param string $allowedCharacters
     * @return bool
     */
    private function hasAtLeastLimitUniqueCharacters(string $code, int $limit, string $allowedCharacters): bool
    {
        $allowedCharactersCount = count_chars($allowedCharacters, 1);
        $codeCharactersCount    = count_chars($code, 1);

        $uniqueCharactersCount = 0;
        foreach ($codeCharactersCount as $character => $count) {
            if (isset($allowedCharactersCount[$character])) {
                $uniqueCharactersCount++;
            }
        }

        return $uniqueCharactersCount >= $limit;
    }

    /**
     * Get the rules for validating characters in the access code to be generated.
     *
     * @return array An array containing the following rules:
     * - 'allowed_characters' (string): A string containing the characters that are allowed.
     * - 'character_repeated_limit' (int): The maximum number of times a character can be repeated consecutively.
     * - 'sequence_length_limit' (int): The maximum length of a character sequence allowed.
     * - 'unique_characters_limit' (int): The maximum number of unique characters allowed in the string.
     */
    private function getRules()
    {
        $defaultRules = [
            'allowed_characters'       => '0123456789',
            'character_repeated_limit' => 3,
            'sequence_length_limit'    => 3,
            'unique_characters_limit'  => 3,
        ];

        // Load rules from Config/rules.php file, if available
        $rules = RulesConfig::$rulesConfig ?? [];

        // Replace the default rules with the rules from Config/rules.php, if available
        return array_replace($defaultRules, $rules);
    }
}
