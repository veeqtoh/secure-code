<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Veeqtoh\DoorAccess\CodeGenerator;
use Veeqtoh\DoorAccess\Provider\ConfigProvider;

/**
 * Class CodeGeneratorTest
 * @package Veeqtoh\DoorAccess
 */
class CodeGeneratorTest extends TestCase
{
    private $configProviderMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock of ConfigProvider
        $this->configProviderMock = $this->createMock(ConfigProvider::class);

        // Set up the mock's behavior to return the rules you want to test
        $this->configProviderMock->expects($this->any())
            ->method('getRules')
            ->willReturn([
                'allowed_characters' => '0123456789',
                'character_repeated_limit' => 3,
                'sequence_length_limit' => 3,
                'unique_characters_limit' => 3,
            ]);
    }
    public function testGenerateCodeReturnsUniqueSixDigitCode()
    {
        $codes     = [];
        $generator = new CodeGenerator($this->configProviderMock);

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode();
            $this->assertMatchesRegularExpression('/^[0-9]{6}$/', $code);
            $this->assertNotContains($code, $codes);
            $codes[] = $code;
        }
    }

    public function testGeneratedCodeIsNotPalindrome()
    {
        $generator = new CodeGenerator($this->configProviderMock);

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode();
            $this->assertFalse($this->isPalindrome($code));
        }
    }

    public function testGeneratedCodeHasNoCharacterRepeatedMoreThanThreeTimes()
    {
        $generator = new CodeGenerator($this->configProviderMock);

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode();
            $this->assertFalse($this->hasCharacterRepeatedMoreThanThreeTimes($code));
        }
    }

    public function testGeneratedCodeHasNoSequenceLengthGreaterThanThree()
    {
        $generator = new CodeGenerator($this->configProviderMock);

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode();
            $this->assertFalse($this->hasSequenceLengthGreaterThanThree($code));
        }
    }

    public function testGeneratedCodeHasAtLeastThreeUniqueCharacters()
    {
        $generator = new CodeGenerator($this->configProviderMock);

        for ($i = 0; $i < 100; $i++) {
            $code = $generator->generateCode();
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

}
