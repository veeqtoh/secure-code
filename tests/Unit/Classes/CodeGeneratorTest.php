<?php

namespace Veeqtoh\DoorAccess\Tests\Unit\Classes;

use Veeqtoh\DoorAccess\Classes\CodeGenerator;
use Veeqtoh\DoorAccess\Contracts\CodeValidator;
use Veeqtoh\DoorAccess\Tests\Unit\TestCase;

class CodeGeneratorTest extends TestCase
{
    public function testGenerateNumericCode(): void
    {
        // Set code format to alphanumeric.
        config(['door-access.code_format' => 'numeric']);

        $generator = new CodeGenerator();
        $code      = $generator->generate();

        $this->assertIsString($code);
        $this->assertMatchesRegularExpression('/^\d+$/', $code);
    }

    public function testGenerateAlphanumericCode(): void
    {
        // Set code format to alphanumeric.
        config(['door-access.code_format' => 'alphanumeric']);

        $generator = new CodeGenerator();
        $code      = $generator->generate();

        $this->assertIsString($code);
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $code);
    }

    public function testGenerateMixedCode(): void
    {
        // Set code format to mixed.
        config(['door-access.code_format' => 'mixed']);

        $generator = new CodeGenerator();
        $code      = $generator->generate();

        $this->assertIsString($code);
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9!@#$%^&*()-_=+[\]{};:<>,.?\/]+$/', $code);
    }

    public function testGenerateWithValidCode(): void
    {
        // Mock validators.
        $validator1 = $this->createMock(CodeValidator::class);
        $validator1->expects($this->once())
                   ->method('isValid')
                   ->willReturn(true);

        $validator2 = $this->createMock(CodeValidator::class);
        $validator2->expects($this->once())
                   ->method('isValid')
                   ->willReturn(true);

        $generator = new CodeGenerator([$validator1, $validator2]);
        $code      = $generator->generate();

        $this->assertIsString($code);
    }
}
