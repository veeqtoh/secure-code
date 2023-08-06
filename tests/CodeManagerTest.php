<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Veeqtoh\DoorAccess\CodeGenerator;
use Veeqtoh\DoorAccess\CodeManager;
use Veeqtoh\DoorAccess\Database\DatabaseInterface;

class CodeManagerTest extends TestCase
{
    public function testAllocateCodeGeneratesUniqueCodeAndStoresInDatabase()
    {
        // Create a mock for CodeGenerator
        $codeGeneratorMock = $this->createMock(CodeGenerator::class);
        $codeGeneratorMock->expects($this->once())
            ->method('generateCode')
            ->willReturn('123456');

        // Create a mock for DatabaseInterface
        $databaseMock = $this->createMock(DatabaseInterface::class);
        $databaseMock->expects($this->once())
            ->method('retrieve')
            ->with('123')
            ->willReturn(null);
        $databaseMock->expects($this->once())
            ->method('store')
            ->with('123', '123456');

        // Create an instance of CodeManager and inject the mocks
        $codeManager = new CodeManager($codeGeneratorMock, $databaseMock);

        // Call the allocateCode method
        $accessCode = $codeManager->allocateCode('123');

        // Assert the access code
        $this->assertEquals('123456', $accessCode);
    }

    public function testAllocateCodeReturnsExistingCodeFromDatabase()
    {
        // Create a mock for CodeGenerator
        $codeGeneratorMock = $this->createMock(CodeGenerator::class);

        // Create a mock for DatabaseInterface
        $databaseMock = $this->createMock(DatabaseInterface::class);
        $databaseMock->expects($this->once())
            ->method('retrieve')
            ->with('123')
            ->willReturn('654321');

        // Create an instance of CodeManager and inject the mocks
        $codeManager = new CodeManager($codeGeneratorMock, $databaseMock);

        // Call the allocateCode method
        $accessCode = $codeManager->allocateCode('123');

        // Assert the access code
        $this->assertEquals('654321', $accessCode);
    }

    public function testResetCodeRemovesCodeFromDatabase()
    {
        // Create a mock for DatabaseInterface
        $databaseMock = $this->createMock(DatabaseInterface::class);
        $databaseMock->expects($this->once())
            ->method('retrieveTeamMemberId')
            ->with('123456')
            ->willReturn('123');

        $databaseMock->expects($this->once())
            ->method('delete')
            ->with('123456')
            ->willReturn(true);

        // Create an instance of CodeManager and inject the mock
        $codeManager = new CodeManager($this->createMock(CodeGenerator::class), $databaseMock);

        // Call the resetCode method
        $result = $codeManager->resetCode('123456');

        // Assert the result
        $this->assertTrue($result);
    }

    public function testResetCodeReturnsFalseForNonExistingCode()
    {
        // Create a mock for DatabaseInterface
        $databaseMock = $this->createMock(DatabaseInterface::class);
        $databaseMock->expects($this->once())
            ->method('retrieveTeamMemberId')
            ->with('654321')
            ->willReturn(null);

        // Create an instance of CodeManager and inject the mock
        $codeManager = new CodeManager($this->createMock(CodeGenerator::class), $databaseMock);

        // Call the resetCode method
        $result = $codeManager->resetCode('654321');

        // Assert the result
        $this->assertFalse($result);
    }
}
