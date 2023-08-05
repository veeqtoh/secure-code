<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Veeqtoh\DoorAccess\CodeGenerator;

class CodeGeneratorTest extends TestCase
{
    public function testGenerateCodeReturnsUniqueSixDigitCode()
    {
        $codes     = [];
        $rules     = $this->getRules();
        $generator = new CodeGenerator();

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode($rules);
            $this->assertMatchesRegularExpression('/^[0-9]{6}$/', $code);
            $this->assertNotContains($code, $codes);
            $codes[] = $code;
        }
    }

    public function testGeneratedCodeIsNotPalindrome()
    {
        $rules     = $this->getRules();
        $generator = new CodeGenerator();

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode($rules);
            $this->assertFalse($this->isPalindrome($code));
        }
    }

    public function testGeneratedCodeHasNoCharacterRepeatedMoreThanThreeTimes()
    {
        $rules     = $this->getRules();
        $generator = new CodeGenerator();

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode($rules);
            $this->assertFalse($this->hasCharacterRepeatedMoreThanThreeTimes($code));
        }
    }

    public function testGeneratedCodeHasNoSequenceLengthGreaterThanThree()
    {
        $rules     = $this->getRules();
        $generator = new CodeGenerator();

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode($rules);
            $this->assertFalse($this->hasSequenceLengthGreaterThanThree($code));
        }
    }

    public function testGeneratedCodeHasAtLeastThreeUniqueCharacters()
    {
        $rules     = $this->getRules();
        $generator = new CodeGenerator();

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode($rules);
            $this->assertTrue($this->hasAtLeastThreeUniqueCharacters($code));
        }
    }

    private function isPalindrome(string $code): bool
    {
        return $code === strrev($code);
    }

    private function hasCharacterRepeatedMoreThanThreeTimes(string $code): bool
    {
        return (bool) preg_match('/(\d)\1{3,}/', $code);
    }

    private function hasSequenceLengthGreaterThanThree(string $code): bool
    {
        return (bool) preg_match('/(\d)\1{2,}/', $code);
    }

    private function hasAtLeastThreeUniqueCharacters(string $code): bool
    {
        return count(array_count_values(str_split($code))) >= 3;
    }

    private function getRules()
    {
        $rules = [
            'allowed_characters'       => '0123456789',
            'character_repeated_limit' => 3,
            'sequence_length_limit'    => 3,
            'unique_characters_limit'  => 3,
        ];
        return $rules;
    }
}
