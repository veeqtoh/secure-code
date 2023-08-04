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
    }

    /**
     * Test if allocateCode generates a unique code and stores it in the database.
     *
     * @return void
     */
    public function testAllocateCodeGeneratesUniqueCodeAndStoresInDatabase()
    {
        //
    }

    /**
     * Test if allocateCode returns an existing code if already allocated to a team member.
     *
     * @return void
     */
    public function testAllocateCodeReturnsExistingCodeIfAlreadyAllocated()
    {
        //
    }

    /**
     * Test if resetCode removes the code from the database.
     *
     * @return void
     */
    public function testResetCodeRemovesCodeFromDatabase()
    {
        //
    }

    /**
     * Test if resetCode returns false if the code is not allocated.
     *
     * @return void
     */
    public function testResetCodeReturnsFalseIfCodeNotAllocated()
    {
        //
    }
}
