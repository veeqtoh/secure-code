<?php
declare(strict_type=1);

namespace Veeqtoh\DoorAccess;

class CodeGenerator
{
    /**
     * Generate a unique 6-digit code.
     *
     * @return string
     */
    public function generateCode(): string
    {
        do {
            $code = $this->generateRandomCode();
        } while (!$this->isCodeValid($code));

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
     * @return bool
     */
    private function isCodeValid(string $code): bool
    {
        return (
            $this->isNotPalindrome($code) &&
            $this->hasNoCharacterRepeatedMoreThanThreeTimes($code) &&
            $this->hasNoSequenceLengthGreaterThanThree($code) &&
            $this->hasAtLeastThreeUniqueCharacters($code)
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
     * Check if the code has no character repeated more than three times.
     *
     * @param string $code
     * @return bool
     */
    private function hasNoCharacterRepeatedMoreThanThreeTimes(string $code): bool
    {
        return !preg_match('/(\d)\1{3,}/', $code);
    }

    /**
     * Check if the code has no sequence length greater than three.
     *
     * @param string $code
     * @return bool
     */
    private function hasNoSequenceLengthGreaterThanThree(string $code): bool
    {
        return !preg_match('/(\d)\1{2,}/', $code);
    }

    /**
     * Check if the code has at least three unique characters.
     *
     * @param string $code
     * @return bool
     */
    private function hasAtLeastThreeUniqueCharacters(string $code): bool
    {
        return count(array_count_values(str_split($code))) >= 3;
    }
}
