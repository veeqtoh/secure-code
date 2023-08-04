<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Veeqtoh\DoorAccess\CodeManager;

class CodeManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set up the database with the door_access_codes table for testing
        // The RefreshDatabase trait will automatically migrate the database before each test
    }

    /**
     * Test if allocateCode generates a unique code and stores it in the database.
     *
     * @return void
     */
    public function testAllocateCodeGeneratesUniqueCodeAndStoresInDatabase()
    {
        // Arrange
        $manager = new CodeManager();

        // Act
        $code1 = $manager->allocateCode('team_member_1');
        $code2 = $manager->allocateCode('team_member_2');

        // Assert
        $this->assertNotNull($code1);
        $this->assertNotNull($code2);
        $this->assertNotEquals($code1, $code2);
    }

    /**
     * Test if allocateCode returns an existing code if already allocated to a team member.
     *
     * @return void
     */
    public function testAllocateCodeReturnsExistingCodeIfAlreadyAllocated()
    {
        // Arrange
        $manager = new CodeManager();

        // Act
        $code1 = $manager->allocateCode('team_member_1');
        $code2 = $manager->allocateCode('team_member_1');

        // Assert
        $this->assertEquals($code1, $code2);
    }

    /**
     * Test if resetCode removes the code from the database.
     *
     * @return void
     */
    public function testResetCodeRemovesCodeFromDatabase()
    {
        // Arrange
        $manager = new CodeManager();

        // Act
        $code = $manager->allocateCode('team_member_1');
        $resetResult = $manager->resetCode($code);

        // Assert
        $this->assertTrue($resetResult);
    }

    /**
     * Test if resetCode returns false if the code is not allocated.
     *
     * @return void
     */
    public function testResetCodeReturnsFalseIfCodeNotAllocated()
    {
        // Arrange
        $manager = new CodeManager();

        // Act
        $resetResult = $manager->resetCode('non_existing_code');

        // Assert
        $this->assertFalse($resetResult);
    }
}
