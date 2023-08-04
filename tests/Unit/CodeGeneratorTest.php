<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Veeqtoh\DoorAccess\CodeGenerator;

class CodeGeneratorTest extends TestCase
{
    /**
     * Test if generateCode returns a unique six-digit code.
     *
     * @return void
     */
    public function testGenerateCodeReturnsUniqueSixDigitCode()
    {
        //
    }

    /**
     * Test if the generated code is not a palindrome.
     *
     * @return void
     */
    public function testGeneratedCodeIsNotPalindrome()
    {
        //
    }

    /**
     * Test if the generated code has no character repeated more than three times.
     *
     * @return void
     */
    public function testGeneratedCodeHasNoCharacterRepeatedMoreThanThreeTimes()
    {
        //
    }

    /**
     * Test if the generated code has no sequence length greater than three.
     *
     * @return void
     */
    public function testGeneratedCodeHasNoSequenceLengthGreaterThanThree()
    {
        //
    }

    /**
     * Test if the generated code has at least three unique characters.
     *
     * @return void
     */
    public function testGeneratedCodeHasAtLeastThreeUniqueCharacters()
    {
        //
    }

    /**
     * Check if a string is a palindrome.
     *
     * @param string $str
     * @return bool
     */
    private function isPalindrome(string $str): bool
    {
        // helper function to check if the string is a palindrome
    }

    /**
     * Check if a string has any character repeated more than three times.
     *
     * @param string $str
     * @return bool
     */
    private function hasRepeatedCharactersMoreThanThreeTimes(string $str): bool
    {
        // helper function to check if the string has any character repeated more than three times
    }

    /**
     * Check if a string has any sequence length greater than three.
     *
     * @param string $str
     * @return bool
     */
    private function hasSequenceLengthGreaterThanThree(string $str): bool
    {
        // helper function to check if the string has any sequence length greater than three
    }

    /**
     * Check if a string has at least three unique characters.
     *
     * @param string $str
     * @return bool
     */
    private function hasAtLeastThreeUniqueCharacters(string $str): bool
    {
        // helper function to check if the string has at least three unique characters
    }
}
